<?php

class Fraction
{
    private int $numerator;

    private int $denominator;

    private function greatestCommonDivisor(int $a, int $b): int
    {
        while (true) {
            if ($a == $b)
                return $a;
            if ($a > $b) {
                $a -= $b;
            } else {
                $b -= $a;
            }
        }
    }

    public function __construct(int $numerator, int $denominator)
    {

        try {
            if (!is_int($numerator)) {
                throw new Exception("Numerator of the wrong type");
            } elseif (!is_int($denominator)) {
                throw new Exception("Denominator of the wrong type");
            }

            if ($denominator == 0) {
                throw new Exception("Denominator is zero");
            }
            if ($numerator == 0) {
                $this->numerator = 0;
                $this->denominator = 1;
                return;
            }

            if ($numerator < 0 and $denominator < 0) {

                $this->numerator = -$numerator;
                $this->denominator = -$denominator;
            } elseif ($numerator > 0 and $denominator < 0) {

                $this->numerator = -$numerator;
                $this->denominator = -$denominator;
            } else {
                $this->numerator = $numerator;
                $this->denominator = $denominator;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }

        $a = abs($this->numerator);
        $b = abs($this->denominator);

        $gcd = $this->greatestCommonDivisor($a, $b);
        $this->numerator /= $gcd;
        $this->denominator /= $gcd;
    }

    public function getDenominator(): int
    {
        return $this->denominator;
    }
    public function getNumerator(): int
    {
        return $this->numerator;
    }
    public function sub(Fraction $frac): Fraction
    {
        $num = ($this->numerator * $frac->getDenominator()) - ($this->denominator * $frac->getNumerator());
        $denom = $this->denominator * $frac->getDenominator();
        return new Fraction($num, $denom);
    }
    public function add(Fraction $frac): Fraction
    {
        $num = ($this->numerator * $frac->getDenominator()) + ($this->denominator * $frac->getNumerator());
        $denom = $this->denominator * $frac->getDenominator();
        return new Fraction($num, $denom);
    }
    public function mult(Fraction $frac): Fraction
    {
        return new Fraction($this->numerator * $frac->getNumerator(), $this->denominator * $frac->getDenominator());
    }

    public function div(Fraction $frac): Fraction
    {
        return new Fraction($this->numerator * $frac->getDenominator(), $this->denominator * $frac->getNumerator());
    }

    public function pow(int $exp): Fraction
    {
        return new Fraction($this->numerator ** $exp, $this->denominator ** $exp);
    }
    public function __toString(): string
    {
        if ($this->numerator == 0) {
            return 0 . "'";
        }

        $integer_part = (int)($this->numerator / $this->denominator);

        if ($integer_part == 0) {
            return (string)($this->numerator . '/' . $this->denominator);
        } else {
            $float_part = ($this->numerator % $this->denominator);
            if ($float_part == 0) {
                return (string)($integer_part . "'");
            } else {
                return (string)($integer_part . "'" . abs($float_part) . '/' . $this->denominator);
            }
        }
    }
}
