<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物件導向</title>
</head>

<body>
    <h1>物件的宣告</h1>
    <?php
    class Animal
    {
        public   $type = 'animal';
        private    $name = 'wick';
        static    $hair = 'brown';

        function __construct($type, $name, $hair)
        {
            $this->type = $type;
            $this->name = $name;
            $this->hair = $hair;
        }

        function run()
        {
            echo $this->name . 'is running';
        }

        function speed()
        {
            echo $this->name . 'is running at 20km/h';
        }
    }

    //實力化(instance)
    $cat = new Animal('cat', 'kitty', 'white');

    echo $cat->type;
    echo $cat->name;
    echo $cat->hair;
    echo $cat->run();
    echo $cat->speed();










    ?>

















</body>

</html>