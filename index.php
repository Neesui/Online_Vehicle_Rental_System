<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="heading2.css">
    <title>Home Page</title>
</head>
<body>
    <?php

        include_once("heading1.php");
    ?>
    <div class="home-main">
        <div class="text">
            <p id="t1"><b>Find  your <br>drive</b></p>
            <p id="t2">Explore the Nepal's largest Online <br>Vehicle Rental Marketplace</p>
        </div>
    </div>

    <div class="middle">
        <p id="m-t1"><b id="find">Find the best</b> <b> car for you</b></p>
        <p id="m-t2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam 
                itaque iusto amet perferendis earum delectus voluptatibus autem 
                ipsum, pariatur praesentium, optio est, cumque neque. Dolorum 
                adipisci quis dolor assumenda quidem!</p>
    </div>

    <div class="home-img">
        <div style="text-align:center">
              <span class="circle"><i class="fa fa-calendar" style="font-size:38px"></i><p id="Icon-num">500+</p><p id="satisfy">Years in Business</p></span>
              <span class="circle"><i class="fa fa-car" style="font-size:38px"></i><p id="Icon-num">500+</p><p id="satisfy">Used Car for Sales</p></span>
              <span class="circle"><i class="fa fa-motorcycle" style="font-size:38px"></i><p id="Icon-num">500+</p><p id="satisfy">Used Bike, Scooter </p></span>
              <span class="circle"><i class="fa fa-user-circle" style="font-size:38px"></i><p id="Icon-num">500+</p><p id="satisfy">Satisfied Customer</p></span>
        </div>
            <p id="t3"><b> Our Satisfied</b> Customers</p>
    </div>

    <?php

        include_once("footer.php");
    ?>
    
<!-- <script>
    // Set a timeout to reload the page after the page has loaded (e.g., 3000 milliseconds = 3 seconds)
    window.onload = function() {
        setTimeout(function() {
            location.reload();
        }, 3000); // Adjust the time as needed
    };
</script> -->
</body>
</html>

