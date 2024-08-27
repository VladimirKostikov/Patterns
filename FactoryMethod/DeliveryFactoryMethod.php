<?php

interface Transport
{
    public function deliver(): string;
}
class Truck implements Transport
{
    public function deliver(): string
    {
        return "Deliver by land in a box.";
    }
}

class Bicycle implements Transport
{
    public function deliver(): string
    {
        return "Deliver by land in a small package.";
    }
}

abstract class Logistics
{
    abstract public function createTransport(): Transport;

    public function planDelivery(): string
    {
        $transport = $this->createTransport();
        return $transport->deliver();
    }
}


class RoadLogistics extends Logistics
{
    public function createTransport(): Transport
    {
        return new Truck();
    }
}

class BikeLogistics extends Logistics
{
    public function createTransport(): Transport
    {
        return new Bicycle();
    }
}

function clientCode(Logistics $logistics)
{
    echo "Client: I'm planning a delivery.\n";
    echo $logistics->planDelivery();
}

echo "App: Launched with RoadLogistics.\n";
clientCode(new RoadLogistics());

echo "\n";

echo "App: Launched with BikeLogistics.\n";
clientCode(new BikeLogistics());