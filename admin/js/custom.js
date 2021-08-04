
//Start for this js is for search data table
    $(document).ready(function(){

  // Search all columns
  $('#txt_searchall').keyup(function(){
    // Search Text
    var search = $(this).val();

    // Hide all table tbody rows
    $('table tbody tr').hide();

    // Count total search result
    var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;

    if(len > 0){
      // Searching text in columns and show match row
      $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
        $(this).closest('tr').show();
        var total_amount = parseFloat($(this).find('.total_amount').text()) || 0;
    
    
        //  $(this).find('.total_amount').text();

        //  $("#forafter").after(`
        // <table>
        //  <thead>
        //  <th>Total Amount</th>
        //  </thead>
        //  <tbody>
        //  <td>total_amount</td>
        //  </tbody>
        // </table>
        // `);



      });
    }else{
      $('.notfound').show();
    }

  });

});
