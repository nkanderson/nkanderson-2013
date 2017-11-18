<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Voting Endorsement Guide - Oregon Primaries 2014" content="">
    <meta name="NKAnderson" content="">

    <title>Voting Endorsement Guide - Oregon 2014</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">2014 Endorsement Guide</a>
        </div>
      </div>
    </div>

    <div id="main" class="container">
      <h2 id="guide">Oregon Primaries - May 20th</h2>
      <h3>Choose endorsers:</h3>
      <form role="form" class="form-horizontal"> <!-- action="get-endorsements.php" method="POST" -->
        <div class="form-group">
          <div class="col-md-6">
            <div class="checkbox">
              <label for="bro" class="checkbox-inline">
                <input name="bro" id="bro" type="checkbox">Basic Rights Oregon (BRO)
              </label>
            </div>
            <div class="checkbox">
              <label for="obpc" class="checkbox-inline">
                <input name="obpc" id="obpc" type="checkbox">Oregon Black Political Convention (OBPC)
              </label>
            </div>
            <div class="checkbox">
              <label for="ufcw" class="checkbox-inline">
                <input name="ufcw" id="ufcw" type="checkbox">United Food &amp; Commercial Workers Local 555 (UFCW555)
              </label>
            </div>
          </div>
          <div class="col-md-6">
            <!-- <div class="checkbox">
              <label for="sfc" class="checkbox-inline">
                <input name="sfc" id="sfc" type="checkbox">Stand for Children Oregon
              </label>
            </div> -->
            <div class="checkbox">
              <label for="sc" class="checkbox-inline">
                <input name="sc" id="sc" type="checkbox">Sierra Club Oregon
              </label>
            </div>
            <div class="checkbox">
              <label for="olcv" class="checkbox-inline">
                <input name="olcv" id="olcv" type="checkbox">Oregon League of Conservation Voters (OLCV)
              </label>
            </div>
            <!-- <div class="checkbox">
              <label for="racc" class="checkbox-inline">
                <input name="racc" id="racc" type="checkbox">Regional Arts &amp; Culture Council
              </label>
            </div>
            <div class="checkbox">
              <label for="pgp" class="checkbox-inline">
                <input name="pgp" id="pgp" type="checkbox">Pacific Green Party of Oregon
              </label>
            </div> -->
          </div>
        </div><!-- End form-group -->
<!--         <h4>Enter zipcode (optional)</h4>
        <div class="form-group">
          <label for="zip" class="col-sm-2">Zip code:</label>
          <div class="col-sm-3">
            <input type="number" id="zip" name="zip" class="form-control">
          </div>
        </div> -->
        <div class="form-group">
          <div class="col-sm-3">
            <button id="get-endorsements" type="submit" class="btn btn-primary">View Candidates</button>
          </div>
        </div>
      </form>
      <div id="results" class="row">

      </div>

    </div><!-- /.container -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $("document").ready(function() {
        $("form").submit(function(e) {
          e.preventDefault();
          var data = $(this).serialize();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: data,
                url: "get-endorsements.php",
                success: inputResults
            })
        })

        function inputResults(data) {
          // data is an object with seat names for properties;
          // each seat name has an object with candidate name,
          // candidate name has an array of endorsers
          var resultsMarkup = '';
          for (var seat in data) {
            resultsMarkup += '<div class="col-md-12">';
            resultsMarkup += '<h3>' + seat + '</h3>';
            for (var candidate in data[seat]) {
              resultsMarkup += '<div class="col-md-6"><p class="h4">' + candidate + '</p>';
              resultsMarkup += '<ul class="list-unstyled endorsers">';
              for (var i in data[seat][candidate]) {
                resultsMarkup += '<li>' + data[seat][candidate][i] + '</li>';
              }
              resultsMarkup += '</ul></div>'
            }
            resultsMarkup += '</div>';
          }
          $('#results').html(resultsMarkup);
        }
    });
    </script>
    <script>
       (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
       m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
       })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
       ga('create', 'UA-40756317-1', 'nkanderson.com');
       ga('send', 'pageview');
     </script>
  </body>
</html>
