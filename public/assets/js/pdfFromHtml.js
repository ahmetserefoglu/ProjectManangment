function HTMLtoPDF(){
var pdf = new jsPDF('p', 'pt', [ 1000, 1400.55]);
source = $('#HTMLtoPDF')[0];
specialElementHandlers = {
	'#bypassme': function(element, renderer){
		return true
	}
}
margins = {
    top: 10,
    left: 10,
    width: 1000
  };
pdf.fromHTML(
  	source // HTML string or DOM elem ref.
  	, margins.left // x coord
  	, margins.top // y coord
  	, {
  		'width': margins.width // max width of content on PDF
  		, 'elementHandlers': specialElementHandlers
  	},
  	function (dispose) {
  	  // dispose: object with X, Y of the last line add to the PDF
  	  //          this allow the insertion of new lines after html
        pdf.save('html2pdf.pdf');
      }
  )		
}

var da = (document.all) ? 1 : 0;
var pr = (window.print) ? 1 : 0;
var mac = (navigator.userAgent.indexOf("Mac") != -1);
function printPage() {
if (pr) // NS4, IE5
window.print()
else if (da && !mac) // IE4 (Windows)
vbPrintPage()
else // other browsers
alert("Sorry, your browser doesn't support this feature.");
return false;
}
if (da && !pr && !mac) with (document) {
writeln('<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>');
writeln('<' + 'SCRIPT LANGUAGE="VBScript">');
writeln('Sub window_onunload');
writeln(' On Error Resume Next');
writeln(' Set WB = nothing');
writeln('End Sub');
writeln('Sub vbPrintPage');
writeln(' OLECMDID_PRINT = 6');
writeln(' OLECMDEXECOPT_DONTPROMPTUSER = 2');
writeln(' OLECMDEXECOPT_PROMPTUSER = 1');
writeln(' On Error Resume Next');
writeln(' WB.ExecWB OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER');
writeln('End Sub');
writeln('<' + '/SCRIPT>');
}