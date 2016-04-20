jQuery(function() {
jQuery(".acf-field-55a015bbf4a54 .acf-soh img").click(function(e) {

  var offset = jQuery(this).offset();
  var relativeX = (e.pageX - offset.left);
  var relativeY = (e.pageY - offset.top);
  var percX = (relativeX / offset.left);
  var pctX = (percX*100).toFixed(1) + "%";
  var percY = (relativeY / offset.top);
  var pctY = (percY*1000).toFixed(1) + "%";

  alert("X: " + pctX + "  Y: " + pctY);

});
});
