<!-- library Maps -->
<input type="text" id="tx" name="">
<script src="https://maps.googleapis.com/maps/api/js?key=TAMBAH KAN API KEY ANDA &libraries=geometry,drawing"></script>
<script src="<?=base_url('assets/')?>node_modules/measuretool-googlemaps-v3/lib/MeasureTool.js"></script>
<script src="<?=base_url('assets/')?>js-map-label/src/maplabel-compiled.js"></script>
<script type="text/javascript" src="<?=base_url('assets/')?>node_modules/html2canvas/dist/html2canvas.min.js"></script>
<!-- <script type="text/javascript" src="<?=base_url('assets/')?>dom-to-image/src/dom-to-image.js"></script> -->
<!-- ----------------- -->
<script type="text/javascript">
	const ax = new ajax;
	let id_ = "<?=$this->session->userdata('project')['id']?>";
	if(!empty(id_)){
		$("#map").show();
	}
  $("#hasil_").hide();
  $("#selesai").hide();

	// if($("#start").text() == "End"){
	// 	$("#map").show();
	// 	$("#inp").hide();
	// }else{
	// 	$("#map").hide();
	// }

	$("#start").click(function(){	
		$("#loadPage").show();
		ax.post_simple("<?=base_url('Admin/ajxMulai')?>",{btn:$(this).text(),project:$("#nama_tanah").val()},respon);
		function respon(response){
			if(response == true){
				$("#loadPage").hide();
			    window.location.assign(location)
			}else{
				$("#loadPage").hide();
         window.location.assign(location)
			}
		}
	});


// control
// ===========

// Google Mpas ======
var drawingManager;
var selectedShape;
var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
var selectedColor;
var colorButtons = {};
var map;
var newpolygons =[];
let obj = {};
var bounds = new google.maps.LatLngBounds();
let total;
var newPolys = [];
let swc = "<?!empty($mapEdit)?'editSwc':''?>";

function clearSelection() {
	measureTool.end();
	if (selectedShape) {
		selectedShape.setEditable(false);
		selectedShape = null;
	}
}

function setSelection(shape) {
	clearSelection();
	selectedShape = shape;
	shape.setEditable(true);
	selectColor(shape.get('fillColor') || shape.get('strokeColor'));
	google.maps.event.addListener(shape.getPath(), 'set_at', calcar);
	google.maps.event.addListener(shape.getPath(), 'insert_at', calcar);
}

function calcar() {
	measureTool.end();
	coordinates = (selectedShape.getPath().getArray());

	newpolygons.length = 0
	newpolygons.push(coordinates);
	var arrays = [];
	const lnght = coordinates.length;
	
	for (var i = 0; i < coordinates.length+1; i++) { 

		if(i != lnght){
			lat = coordinates[i].lat(); 
			lng = coordinates[i].lng(); 

		}else{
			lat = coordinates[0].lat(); 
			lng = coordinates[0].lng(); 
		}
		arrays.push({lat:lat,lng:lng});	
			// console.log();
			// console.log(lng);
   } 
   newpolygons.push(arrays);


    // var area = google.maps.geometry.spherical.computeArea(selectedShape.getPath());
  }

  function deleteSelectedShape() {
   if (selectedShape) {
    newpolygons.length = 0
      $("#hasil_").hide();
      measureTool.end();
      $("#laporan").text("Compail");
    selectedShape.setMap(null);
  }
}

function selectColor(color) {
	selectedColor = color;
	for (var i = 0; i < colors.length; ++i) {
		var currColor = colors[i];
		colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
	}

  // Retrieves the current options from the drawing manager and replaces the
  // stroke or fill color as appropriate.
  var polylineOptions = drawingManager.get('polylineOptions');
  polylineOptions.strokeColor = color;
  drawingManager.set('polylineOptions', polylineOptions);

  var rectangleOptions = drawingManager.get('rectangleOptions');
  rectangleOptions.fillColor = color;
  drawingManager.set('rectangleOptions', rectangleOptions);

  var circleOptions = drawingManager.get('circleOptions');
  circleOptions.fillColor = color;
  drawingManager.set('circleOptions', circleOptions);

  var polygonOptions = drawingManager.get('polygonOptions');
  polygonOptions.fillColor = color;
  drawingManager.set('polygonOptions', polygonOptions);
}

function setSelectedShapeColor(color) {
	if (selectedShape) {
		if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
			selectedShape.set('strokeColor', color);
		} else {
			selectedShape.set('fillColor', color);
		}
	}
}

function makeColorButton(color) {
	var button = document.createElement('span');
	button.className = 'color-button';
	button.style.backgroundColor = color;
	google.maps.event.addDomListener(button, 'click', function() {
		selectColor(color);
		setSelectedShapeColor(color);
	});

	return button;
}

function buildColorPalette() {
	var colorPalette = document.getElementById('color-palette');
	for (var i = 0; i < colors.length; ++i) {
		var currColor = colors[i];
		var colorButton = makeColorButton(currColor);
		colorPalette.appendChild(colorButton);
		colorButtons[currColor] = colorButton;
	}
	selectColor(colors[0]);
}

function initialize() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 10,
		center: new google.maps.LatLng(-0.535194, 101.564598),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true,
		zoomControl: true,
    fullscreenControl: true,
    mapTypeControl: true
	});
	measureTool = new MeasureTool(map, {
		contextMenu: false,
		showSegmentLength: true,
		tooltip: true,
      unit: MeasureTool.UnitTypeId.METRIC // metric, imperial, or nautical
    });

	var polyOptions = {
		strokeWeight: 0,
		fillOpacity: 0.45,
		editable: true
	};
  // Creates a drawing manager attached to the map that allows the user to draw
  // markers, lines, and shapes.
  drawingManager = new google.maps.drawing.DrawingManager({
  	drawingMode: google.maps.drawing.OverlayType.POLYGON,
  	markerOptions: {
  		draggable: true
  	},
  	polylineOptions: {
  		editable: true
  	},
  	rectangleOptions: polyOptions,
  	circleOptions: polyOptions,
  	polygonOptions: polyOptions,
  	map: map
  });

  google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
  	if (e.type != google.maps.drawing.OverlayType.MARKER) {
      // Switch back to non-drawing mode after drawing a shape.
      drawingManager.setDrawingMode(null);

      // Add an event listener that selects the newly-drawn shape when the user
      // mouses down on it.
      var newShape = e.overlay;
      newShape.type = e.type;
      google.maps.event.addListener(newShape, 'click', function() {
      	setSelection(newShape);
      });
      var area = google.maps.geometry.spherical.computeArea(newShape.getPath());
      // console.log(area.toFixed(2));
      setSelection(newShape);
    }
  });


  
  google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
  	coordinates = (polygon.getPath().getArray());
  	newpolygons.push(coordinates);
  	var arrays = [];
  	const lnght = coordinates.length;
  	for (var i = 0; i < coordinates.length+1; i++) { 

  		if(i != lnght){
  			lat = coordinates[i].lat(); 
  			lng = coordinates[i].lng(); 

  		}else{
  			lat = coordinates[0].lat(); 
  			lng = coordinates[0].lng(); 
  		}
  		bounds.extend({lat:lat,lng:lng});
  		arrays.push({lat:lat,lng:lng});	
			// console.log();
			// console.log(lng);
		}  
		newpolygons.push(arrays);
		console.log(measureTool.areaText);
	});
  function mapClick(){
    $("#hasil_").hide();
     measureTool.end();
    $("#laporan").text("Compail");
    // newpolygons.length = 0;
  }

  // Clear the current selection when the drawing mode is changed, or when the
  // map is clicked.
  google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
  google.maps.event.addListener(map, 'click', mapClick);
  google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);

  buildColorPalette();
  $("#laporan").click(function() {
    if($(this).text()  == "Hitung"){
      measureTool.start(newpolygons[1]);  
      $("#bidang").html(measureTool.areaText);
      $("#hasil_").show();
    }
  	if($(this).text() == "Compail"){
  		measureTool.start(newpolygons[1]);	
      $("#bidang").html(measureTool.areaText);
      if($(this).text()  == "Compail"){
        $(this).text("Hitung");  
      }

      



  		// let ht = '<table border="1"><thead><tr><td>lat</td><td>lng</td><td>Panjang</td></tr></thead><tbody>';

  		// for(let i=0;i < newpolygons[1].length -1 ; i++){
  		// 	ht +="<tr>";
  		// 	ht += "<td>"+newpolygons[1][i].lat+"</td>";
  		// 	ht += "<td>"+newpolygons[1][i].lng+"</td>";
  		// 	ht += "<td>"+measureTool._segments[i].length.text+"</td>";
  		// 	ht +="</tr>";
  		// }
  		// ht +="</tbody></table>";
  		// $("#koordinat").html(ht);
  	}
  	





  	// var myLatlng = bounds.getCenter();
  	// mapLabel = new MapLabel({
  	// 	text: "Luas Wilayah:",
  	// 	position: myLatlng,
  	// 	map: map,
  	// 	fontSize: 10,
  	// 	align: 'Center'
  	// });
  	// mapLabel.set('fontColor', "#ff0000");
  });

    $("#save_area").click(function() {
      if($("#save_area").text() == "Edit"){
        $("#laporan").show();
        $("#laporan").text("Compail");
        // newpolygons.length = 0
        measureTool.end();
        $("#selesai").hide();
        $(this).text("Save");
      }else{
        $("#loadPage").show();
         ax.post_simple("<?=base_url('Admin/ajx_pengukuran')?>",{
          luas : measureTool.areaText,
          xy   : newpolygons[1]
        },respon);
      }
      
       function respon(response){
        $("#loadPage").hide();
        $("#selesai").show();
        console.log(response);
      }

    });
    $("#selesai").click(function() {
      $("#laporan").hide();
      $("#save_area").text("Edit");

    });
    $("#rep").click(function() {
      var element = document.getElementById("map");
      // // var node = document.getElementById('my-node');
        $("#loadPage").show();
      html2canvas(element,{
        useCORS: true,
        allowTaint: false,
        // ignoreElements: (node) => {
        //   return node.nodeName === 'IFRAME';
        // }
      }).then(canvas => {
        
        let dataUrl= canvas.toDataURL("image/png");

        // setTimeout(function(){ alert("Hello"); }, 3000);
        var myRedirect = function(redirectUrl, arg, value) {
          var form = $('<form action="' + redirectUrl + '" method="post">' +
            '<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
          $('body').append(form);
          $(form).submit();
          $("#loadPage").hide();
        };

        myRedirect("<?=base_url('Admin/laporan_luasTanah')?>","imgs",dataUrl);

        // postAndRedirect("<?=base_url('Admin/laporan_luasTanah')?>",dataUrl);
        $("#tx").val(dataUrl);

      });


    });

  measureTool.addListener('measure_end', (e) => {
  	console.log('ended', e.result);
  });


     // /* Load Shapes that were previously saved */
     // let areas = [{"lat":-0.34966098906502313,"lng":101.39344188417007},{"lat":-0.3743797337259019,"lng":101.63376781190445},{"lat":-0.4965990804889175,"lng":101.4827058001857},{"lat":-0.34966098906502313,"lng":101.39344188417007}];



  if(!empty(swc)){
    
    ax.post_simple("<?=base_url('Admin/ajaxPolygon')?>",{},data_polygon);
    
    function data_polygon(res){
      let areas = [];
      const jsons = JSON.parse(res);
      for(let i = 0; i< jsons.length; i++){
        let pol = {lat:parseFloat(jsons[i].let),lng:parseFloat(jsons[i].lng)};
        areas.push(pol);
      }
      let ars = areas;
      
      let newPolys = new google.maps.Polygon({
        path: ars,
        strokeWeight: 0,
        fillColor: ars.fillColor,
        fillOpacity: ars.fillOpacity
      });
      newPolys.setMap(map);
      setSelection(newPolys);
      addNewPolys(newPolys);

      function addNewPolys(newPoly) {
        google.maps.event.addListener(newPoly, 'click', function() {
          setSelection(newPoly);
        });
      }
      measureTool.start(ars);     
      g 
    }

    // console.log(areas);  
  }

}

google.maps.event.addDomListener(window, 'load', initialize);

// ===================


function array2json(arr) {
	var parts = [];
	var is_list = (Object.prototype.toString.apply(arr) === '[object Array]');

	for(var key in arr) {
		var value = arr[key];
        if(typeof value == "object") { //Custom handling for arrays
        	if(is_list) parts.push(array2json(value)); /* :RECURSION: */
        	else parts[key] = array2json(value); /* :RECURSION: */
        } else {
        	var str = "";
        	if(!is_list) str = '"' + key + '":';

            //Custom handling for multiple data types
            if(typeof value == "number") str += value; //Numbers
            else if(value === false) str += 'false'; //The booleans
            else if(value === true) str += 'true';
            else str += '"' + value + '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Functions?)

            parts.push(str);
          }
        }
        var json = parts.join(",");

    if(is_list) return '{' + json + '}';//Return numerical JSON
    // return '{' + json + '}';//Return associative JSON
  }

  function postAndRedirect(url, postData)
  {
    var postFormStr = "<form method='POST' action='" + url + "'>\n";

    for (var key in postData)
    {
      if (postData.hasOwnProperty(key))
      {
        postFormStr += "<input type='hidden' name='" + key + "' value='" + postData[key] + "'></input>";
      }
    }

    postFormStr += "</form>";

    var formElement = $(postFormStr);

    $('body').append(formElement);
    $(formElement).submit();
    $("#loadPage").hide();
  }





// var element = document.getElementById("map");
    // html2canvas(element).then(canvas => {
    //   var dataUrl= canvas.toDataURL("image/png");
    //   $("#tx").val(dataUrl);
    // });
  </script>
