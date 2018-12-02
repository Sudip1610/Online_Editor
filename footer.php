
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

      <script type="text/javascript">

        $(".toggleForms").click(function() {

            $("#signUpForm").toggle();
            $("#logInForm").toggle();


        });

        function updateOutput() {

            $("#outputPanel").contents().find("html").html("<html><head><style type='text/css'>" + $("#css").val() + "</style></head><body>" + $("#html").val() + "</body></html>");

            document.getElementById("outputPanel").contentWindow.eval($("#js").val());

            }
            updateOutput();

         $("textarea").on('change keyup paste', function() {

             updateOutput();

             });

          $('#diary').bind('input propertychange', function() {

                $.ajax({
                  method: "POST",
                  url: "updatedatabase.php",
                  data: { content: $("#diary").val() }
                });

        });

        $('#html').bind('input propertychange', function() {

              $.ajax({
                method: "POST",
                url: "updatedatabase.php",
                data: { content1: $("#html").val() }
              });

      });

      $('#css').bind('input propertychange', function() {

            $.ajax({
              method: "POST",
              url: "updatedatabase.php",
              data: { content2: $("#css").val() }
            });

    });

    $('#js').bind('input propertychange', function() {

          $.ajax({
            method: "POST",
            url: "updatedatabase.php",
            data: { content3: $("#js").val() }
          });

  });


      </script>

  </body>
</html>
