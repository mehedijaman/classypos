$(document).ready(function(){
      // Disable Right Click
if (document.addEventListener) { // IE >= 9; other browsers
  document.addEventListener('contextmenu', function(e) {
    alertify.warning('<strong><i class="fa fa-thumbs-up"></i> Wecome to <span class="logo-lg">TechLab</span></strong>'); 
    e.preventDefault();
  }, false);
} 
else { // IE < 9
  document.attachEvent('oncontextmenu', function() {
    alertify.warning('<strong><i class="fa fa-thumbs-up"></i> Wecome to <span class="logo-lg">TechLab</span></strong>'); 
    window.event.returnValue = false;
  });
}
});

function WindowPrint(){
  setTimeout(function () { window.print(); }, 0);
  window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
}