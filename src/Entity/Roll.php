<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DiceCalc\Calc;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"
 *     },
 *     collectionOperations={
 *          "get"
 *     }
 * )
 */
class Roll
{
    /**
     * @ApiProperty(identifier=true)
     *
     * @var string
     */
    public $expression;

    /**
     * @ApiProperty()
     *
     * @var int
     */
    public $result;

    /**
     * @ApiProperty()
     *
     * @var string
     */
    public $dice;

    public function __construct($expression)
    {
        $this->expression = $expression;

        $diceRoll = new Calc($this->expression);

        $this->result = $diceRoll();
        $this->dice = $diceRoll->infix();
    }
}
