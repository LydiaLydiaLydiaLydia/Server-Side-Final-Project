function departureSelect(){
    $pdo = new PDO('mysql:host=localhost;dbname=FerrySYS; charset=utf8', 'root', ''); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT DepPort, DepTime, ArrTime, Capacity FROM Departures';
        $result = $pdo->query($sql);
        return $result;
}