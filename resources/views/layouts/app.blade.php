<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" media="all" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon.png" />

    <title>Global Relief Trust</title>
    <!-- Begin CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/609d6d90d8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet" />

    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/responsive.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/checkout.css') }}" type="text/css" rel="stylesheet" />

    <!-- Begin Crowdfunding css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cf-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cf-custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cf-responsive.css') }}">

    <?php echo setting('site.header_tag'); ?>
    <!--// End CSS -->
    <script src="https://js.stripe.com/v3/"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="app"></div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://theplayculture.com/grt/public/js/app.js" type="text/javascript"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@ideal-postcodes/postcode-lookup-bundled/dist/postcode-lookup.js"></script>
    <script type="text/javascript">
    window.onload = function(){
        //alert(1);
    IdealPostcodes.PostcodeLookup.setup({
        
        apiKey: 'ak_l8sp5kelbfEbfNRzVpNqjid2HZPvt',
        context: "#postcodeSearch",
        outputFields: {
            line_1: '#addressLine1',
            line_2: '#addressLine2',
            post_town: '#postCity',
            postcode: '#postCode'
        }
    });
    }
    </script>
      <script src="{{ asset('./js/app.js') }}"></script>
</body>

</html>
