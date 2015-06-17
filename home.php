<?php
/**
 * The template for displaying homepage
 *
 * .
 */


get_header(); ?>
		
	<script type="text/javascript">
	  $(document).ready(function(){
		    setTimeout(function(){
		      window.tremula = createTremula();
		      applyBoxClick();
		      loadFlickr()
		    },0);
		  });
		
		
		  function createTremula(){
		
		    // .tremulaContainer must exist and have actual dimentionality 
		    // requires display:block with an explicitly defined H & W
		    $tremulaContainer = $('.tremulaContainer');
		
		    //this creates a hook to a new Tremula instance
		    var tremula = new Tremula();
		    
		    // Celand Wordpress Preferences
		    var tremula_name = "<?php echo $tremula_type; ?>";
		    var tremula_type;
			if (tremula_name == 'bezierShape') tremula_type = tremula.projections.bezierShape;
			else if (tremula_name == 'sunrise') tremula_type = tremula.projections.sunrise;
			else if (tremula_name == 'mountain') tremula_type = tremula.projections.mountain;
			else if (tremula_name == 'bezierQuad') tremula_type = tremula.projections.bezierQuad;
			else if (tremula_name == 'enterTheDragon') tremula_type = tremula.projections.enterTheDragon;
			else if (tremula_name == 'xyPlain') tremula_type = tremula.projections.xyPlain;
			else if (tremula_name == 'pinterest') tremula_type = tremula.projections.pinterest;
			else if (tremula_name == 'turntable') tremula_type = tremula.projections.turntable;
			else if (tremula_name == 'streamHorizontal') tremula_type = tremula.projections.streamHorizontal;
			else if (tremula_name == 'xyBumpTaper') tremula_type = tremula.projections.xyBumpTaper;
			else tremula_type = tremula.projections.xyPlain;
	
			console.log("tremula_type",tremula_type);
			
		    var tremula_thumb_type = parseInt("<?php echo $tremula_thumb_type; ?>");	
		    var tremula_nthumb_type = parseInt("<?php echo $tremula_nthumb_type; ?>");	
		
		    //Create a config object -- this is how most default behaivior is set.
		    //see updateConfig(prop_val_object,refreshStreamFlag) method to change properties of a running instance
		    var config = {
		
		      //Size of the static axis in pixels
		       //If your scroll axis is set to 'x' then this will be the normalized height of your content blocks.
		       //If your scroll axis is set to 'y' then this will be the normalized width of your content blocks.
		      itemConstraint      :tremula_thumb_type,//px
		
		      //Margin in px added to each side of each content item
		      itemMargins         :[5,15],//x (left & right), y (top & bottom) in px
		
		      //Display offset of static axis (static axis is the non-scrolling dimention)
		      staticAxisOffset    :0,//px
		
		      //Display offset of scroll axis (this is the amount of scrollable area added before the first content block)
		      scrollAxisOffset    :20,//px
		
		      //Sets the scroll axis 'x'|'y'.
		      //NOTE: projections generally only work with one scroll axis
		      //when changeing this value, make sure to use a compatible projection
		      scrollAxis          :'x',//'x'|'y'
		
		      //surfaceMap is the projection/3d-effect which will be used to display grid content
		      //following is a list of built-in projections with their corresponding scroll direction
		      //NOTE: Using a projection with an incompatible Grid or Grid-Direction will result in-not-so awesome results
		      //----------------------
		      // (x or y) xyPlain
		      // (x) streamHorizontal
		      // (y) pinterest
		      // (x) mountain
		      // (x) turntable
		      // (x) enterTheDragon
		      //----------------------
		      // surfaceMap          :tremula.projections.bezierShape,
		      surfaceMap          :tremula_type,
		
		      //how many rows (or colums) to display.  note: this is zero based -- so a value of 0 means there will be one row/column
		      staticAxisCount     :tremula_nthumb_type,//zero based 
		
		      //the grid that will be used to project content
		      //NOTE: Generally, this will stay the same and various surface map projections
		      //will be used to create various 3d positioning effects
		      defaultLayout       :tremula.layouts.xyPlain,
		
		      //it does not look like this actually got implemented so, don't worry about it ;)
		      itemPreloading      :true,
		
		      //enables the item-level momentum envelope
		      itemEasing          :false,
		
		      //enables looping with the current seet of results
		      isLooping         	:false,
		
		      //if item-level easing is enabled, it will use the following parameters
		      //NOTE: this is experimental. This effect can make people queasy.
		      itemEasingParams    :{
		        touchCurve          :tremula.easings.easeOutCubic,
		        swipeCurve          :tremula.easings.easeOutCubic,
		        transitionCurve     :tremula.easings.easeOutElastic,
		        easeTime            :500,
		        springLimit         :40 //in px
		      },
		
		      //method called after each frame is painted. Passes internal parameter object.
		      //see fn definition below
		      onChangePub					: doScrollEvents,
		
		      //content/stream data can optionally be passed in on init()
		      data                : null,
		
		      // lastContentBlock enables a persistant content block to exist at the end of the stream at all times.
		      // Common use case is to target $('.lastContentItem') with a conditional loading spinner when API is churning.
		      lastContentBlock 		: {
		        template :'<div class="lastContentItem"></div>',
		        layoutType :'tremulaBlockItem',
		        noScaling:true,
		        w:300,
		        h:300,
		        isLastContentBlock:true,	
		        adapter:tremula.dataAdapters.TremulaItem
		      },
		
		      //dafault data adapter method which is called on each data item -- this is used if none is supplied during an import operation
		      //enables easy adaptation of arbitrary API data formats -- see flickr example
		      adapter             :null
		
		    };
		
		    //initalize the tremula instance with 3 parameters: 
		    //a DOM container, a config object, and a parent context
		    tremula.init($tremulaContainer,config,this);
		
		    //return the tremula hook 
		    return tremula;
		  }
		
		  //This method is called on each paint frame thus enabling low level behaivior control
		  //it receives a single parameter object of internal instance states
		  //NOTE: below is a simple example of infinate scrolling where new item
		  //requests are made when the user scrolls past the existing 70% mark.
		  //
		  //Another option here is multiple tremula instancechaining i.e. follow the scroll events of another tremula instance.
		  //use case of this may be one tremula displaying close up data view while another may be an overview.
		  function doScrollEvents(o){
		    if(o.scrollProgress>.7){
		      if(!tremula.cache.endOfScrollFlag){
		        tremula.cache.endOfScrollFlag = true;
		        pageCtr++;
		        loadFlickr();
		        console.log('END OF SCROLL!')
		      }
		    }
		  };
		
		
		  //Basic example of API integration
		  //=================================
		  //DATA FUNCTIONS OF NOTE: 
		  //tremula.refreshData(returned_set_array,dataAdapter)//replaces current data set with returned_set_array
		  //tremula.appendData(returned_set_array,dataAdapter)//appends current data set with returned_set_array
		  //tremula.insertData(returned_set_array,dataAdapter)//prepends current data set with returned_set_array
		  //=================================
		  /* SIZE SUFFIX FOR FLICKR IMAGE URLS ===> must be set in method below also
		  s	small square 75x75
		  q	large square 150x150
		  t	thumbnail, 100 on longest side
		  m	small, 240 on longest side
		  n	small, 320 on longest side
		  -	medium, 500 on longest side
		  z	medium 640, 640 on longest side
		  c	medium 800, 800 on longest side†
		  b	large, 1024 on longest side*
		  o	original image, either a jpg, gif or png, depending on source format
		  */
		  var pageCtr = 1;
		  var nposts = 40;
		  function loadFlickr(){
		    var dataUrl = "/?json=1&include=url,title,thumbnail&count="+nposts;
		    $.ajax({
		      url:dataUrl
		      ,dataType: 'jsonp'
		      ,jsonp: 'callback' 
		    })
		    .done(function(res){
		      console.log('API success',res); 
		      if (res.stat=='fail')alert('Dang. Looks like API has lost its pancakes... '+res.message);
		      console.log(res);
		      var rs = res.posts.filter(function(o,i){if (o.thumbnail_images) return o.thumbnail_images.thumbnail.height > o.thumbnail_images.thumbnail.width * .5});//filter out any with a really wide aspect ratio.
		      tremula.appendData(rs,flickrDataAdapter);//flicker 
		      tremula.cache.endOfScrollFlag = false;
		    })
		    .fail( function(d,config,err){console.log('API FAIL. '+err) })}
		
		  // DATA ADAPTER EXAMPLE
		  //=====================
		  // flickrDataAdapter() modified for WordPress API (Json API PlugIn)
		  // https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=c149b994c54c114bd7836b61539eec2e&tags=sky%2C+night%2C+day&format=json&page=1
		
		
		  function flickrDataAdapter(data,env){
		    this.data = data;
		    console.log('data',data);
		    this.w = this.width = data.thumbnail_images.thumbnail.width;
		    this.h = this.height = data.thumbnail_images.thumbnail.height;
		    this.imgUrl = data.thumbnail_images.thumbnail.url;
		    this.auxClassList = "flickrRS";//stamp each mapped item with map ID 
		    this.itemTitle = data.title||'test';
				    
		    this.template = this.data.template||('<img draggable="false" class="moneyShot" onload="imageLoaded(this)" src=""/> <div class="boxLabel">{{Title}}</div>')
						.replace(/{{Title}}/g,this.data.title);
		    
		  }
		
		  // updateConfig() enables updating of configuration parameters after an instance is running.
		  // adding an optional true parameter will force a tremula grid redraw with the new parameter in effect
		  // ----------------------------
		  // EXAMPLE: tremula.Grid.updateConfig({itemConstraint:100},true);
		  // ----------------------------
		
		  // Use toggleScrollAxis() to set the scrollAxis, 
		  // see: surfaceMap projection compatibility list above to ensure the projection is compatible with the scrollAxis value
		  // ----------------------------
		  // EXAMPLE: tremula.Grid.toggleScrollAxis('y'); 
		  // ----------------------------
		
		  function applyBoxClick(){
		    $('.tremulaContainer').on('tremulaItemSelect',function(gestureEvt,domEvt){
		      // console.log(gestureEvt,domEvt)
		      var 
		        $e = $(domEvt.target);
		        t = $e.closest('.gridBox')[0];
		      if(t){
		        var data = $.data(t).model.model.data;
		      }
		      if(data) {  //alert(JSON.stringify(data)); 
		                location.replace(data.url); 
		                }
		    })
		  }


	</script>	
		
	<div id="primary" class="content-area">
		 <div class="pageLayoutContainer">
 		 
			<div class="tremulaContainer"></div>
			
      		 <span class="cta"></span>
  	  	</div>
	</div><!-- .content-area -->

<?php wp_footer(); ?>
