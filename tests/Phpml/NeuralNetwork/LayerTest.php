<?php

declare(strict_types=1);

namespace tests\Phpml\NeuralNetwork;

use Phpml\NeuralNetwork\Layer;
use Phpml\NeuralNetwork\Node\Bias;
use Phpml\NeuralNetwork\Node\Neuron;
use PHPUnit\Framework\TestCase;

class LayerTest extends TestCase
{
    public function testLayerInitialization(): void
    {
        $layer = new Layer();

        $this->assertEquals([], $layer->getNodes());
    }

    public function testLayerInitializationWithDefaultNodesType(): void
    {
        $layer = new Layer($number = 5);

        $this->assertCount($number, $layer->getNodes());
        foreach ($layer->getNodes() as $node) {
            $this->assertInstanceOf(Neuron::class, $node);
        }
    }

    public function testLayerInitializationWithExplicitNodesType(): void
    {
        $layer = new Layer($number = 5, $class = Bias::class);

        $this->assertCount($number, $layer->getNodes());
        foreach ($layer->getNodes() as $node) {
            $this->assertInstanceOf($class, $node);
        }
    }

    /**
     * @expectedException \Phpml\Exception\InvalidArgumentException
     */
    public function testThrowExceptionOnInvalidNodeClass(): void
    {
        new Layer(1, \stdClass::class);
    }

    public function testAddNodesToLayer(): void
    {
        $layer = new Layer();
        $layer->addNode($node1 = new Neuron());
        $layer->addNode($node2 = new Neuron());

        $this->assertEquals([$node1, $node2], $layer->getNodes());
    }
}
