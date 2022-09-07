
</body>

<script>
  $( function() {
    $( "#start_date" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        maxDate: '0',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate());     
            $("#end_date").datepicker("option", "minDate", dt);
        }

    });

    $( "#end_date" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#start_date").datepicker("option", "maxDate", dt);
        }
    });

  } );
  </script>




</html>