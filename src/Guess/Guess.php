<?php

namespace Supe\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */

    private $number;
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 5.
     */

    public function __construct(int $number = -7, int $tries = 5)
    {
        $this->number = $number;
        $this->tries = $tries;
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }

    public function useOneTry()
    {
        $this->tries--;
    }

    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }

    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess1($number)
    {
        if ($number > 100 || $number < 1) {
            throw new GuessException("Du kan bara gissa ett nummer mellan 1 och 100.");
        } elseif ($this->tries < 1) {
            return "DU FÖRLORAR! Du har använt alla gissningar redan!";
        } elseif ($this->number == $number) {
            return "KORREKT!";
        } elseif ($this->number < $number) {
            return "FÖR HÖGT!";
        } else {
            return "FÖR LÅGT!";
        }
    }

    public function makeGuess($number)
    {
        if ($number > 100 || $number < 1) {
            throw new GuessException("Du kan bara gissa ett nummer mellan 1 och 100.");
        } elseif ($this->number == $number) {
            return "Din gissning är KORREKT! Du vann!";
        } elseif ($this->number < $number) {
            $this->tries --;
            return "Din gissning är FÖR HÖG! Försök igen.";
        } else {
            $this->tries --;
            return "Din gissning är FÖR LÅG! Försök igen.";
        }
    }
}
