var table;
$(document).ready(function () {
     table = $('#example').DataTable({
      'columnDefs': [{
      'targets': 0,
      'checkboxes': {
               'selectRow': true
            },

      'className': 'dt-body-center',
      /*'render': function (data, type, full, meta){
          return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
      },*/
      'createdRow': function(row, data, dataIndex){
         $(row).attr('id', 'row-' + dataIndex);
      },
      'select': {
         'style': 'multi'
      },
   }]/*,
      dom: 'Alfrtip',

      alphabetSearch: {
         column: 0
      }*/

   });

var checkBox = document.getElementById("example-select-all");

     if (checkBox.checked == true){
console.log("asdsa");
         

        $("#edit").attr("style", "display:none");
        $("#show").attr("style", "display:none");
        $("#mail").attr("style", "display:none");
          

     }else{
console.log("asdsssaa");
$('#test').click(function() {
               $("#edit").removeAttr("style");
           $("#show").removeAttr("style");
            $("#mail").removeAttr("style");

         console.log($('#example-select-all:checked').map(function() {
             return this.value;
         }).get().join(', '));
         });
     }
  

    table.MakeCellsEditable({
        "onUpdate": myCallbackFunction,
        "inputCss":'my-input-class',
        "columns": [0,1,2,3,4,5,6,7,8,9,10,11],
        "allowNulls": {
            "columns": [3],
            "errorClass": 'error'
        },
        "confirmationButton": { // could also be true
            "confirmCss": 'my-confirm-class',
            "cancelCss": 'my-cancel-class'
        },
        "inputTypes": [
            {
                "column": 0,
                "type": "text",
                "options": null
            },
            {
                "column":1, 
                "type": "list",
                "options":[
                    { "value": "1", "display": "Beaty" },
                    { "value": "2", "display": "Doe" },
                    { "value": "3", "display": "Dirt" }
                ]
            },
            {
                "column": 2,
                "type": "datepicker", // requires jQuery UI: http://http://jqueryui.com/download/
                "options": {
                    "icon": "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" // Optional
                }
            }
             // Nothing specified for column 3 so it will default to text
            
        ]
    });


// Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });


// Handle form submission event
   $('#frm-example').on('submit', function(e){
      var form = this;

      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });
   });

table.rowReordering();

});

function myCallbackFunction (updatedCell, updatedRow, oldValue) {
    console.log("The new value for the cell is: " + updatedCell.data());
    console.log("The old value for that cell was: " + oldValue);
    console.log("The values for each cell in that row are: " + updatedRow.data());
}

function destroyTable() {
    if ($.fn.DataTable.isDataTable('#myAdvancedTable')) {
        table.destroy();
        table.MakeCellsEditable("destroy");
    }
}