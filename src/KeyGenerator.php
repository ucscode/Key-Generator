<?php

namespace Ucscode\KeyGenerator;

class KeyGenerator
{
    protected const SPECIAL_CHARS = [
        '!', 
        '@', 
        '#', 
        '$', 
        '%', 
        '^', 
        '&', 
        '*', 
        '(', 
        ')', 
        '[', 
        ']', 
        '{', 
        '}', 
        '/', 
        ':', 
        '.', 
        ';', 
        '|', 
        '>', 
        '~', 
        '_', 
        '-'
    ];

    protected array $characters;

    public function __construct(string|array $characters = [])
    {
        $this->characters = !empty($characters) ? 
            $this->moderateCharacters($characters) :
            [
                ...array_map('strval', range('0', '9')), 
                ...range('a', 'z'), 
                ...range('A', 'Z')
            ];
    }

    /**
     * Define a character set from which the random keys will be generated
     *
     * @param string|array $characters
     * @return static
     */
    public function setCharacters(string|array $characters): static
    {
        $this->characters = $this->moderateCharacters($characters);

        return $this;
    }

    /**
     * Add more values to the character set
     *
     * @param string|array $characters
     * @return static
     */
    public function addCharacters(string|array $characters): static
    {
        $this->characters = $this->moderateCharacters([
            ...$this->characters, 
            ...$this->moderateCharacters($characters)
        ]);

        return $this;
    }

    /**
     * Remove values from the character set
     *
     * @param string|array $characters
     * @return static
     */
    public function removeCharacters(string|array $characters): static
    {
        $this->characters = array_diff($this->characters, $this->moderateCharacters($characters));

        return $this;
    }

    /**
     * Include special characters in the generated key
     * 
     * By default only random numbers and alphabets are generated unless this method argument 
     * is set to true or you explicitly add special characters into the character set
     *
     * @param boolean $include  Whether to include special characters to the generated key
     * @return static
     */
    public function applySpecialCharacters(bool $include = true): static
    {
        $include ? $this->addCharacters(self::SPECIAL_CHARS) : $this->removeCharacters(self::SPECIAL_CHARS);

        return $this;
    }

    /**
     * Generate a new set of random characters
     *
     * @param integer $length       The length of characters to generate
     * @param string|null $prefix   Prepend a fixed string to the generated characters
     * @param string|null $suffix   Append a fixed string to the generated characters
     * @return string               Random characters
     */
    public function generateKey(int $length = 10, ?string $prefix = null, ?string $suffix = null): string
    {
        $collection = [$prefix];
        
        for ($index = 0; $index < abs($length); $index++) {
            $randomIndex = array_rand($this->characters);
            $collection[] = $this->characters[$randomIndex];
        }

        $collection[] = $suffix;

        return implode($collection);
    }

    /**
     * Returns an array containing only unique chars
     *
     * @param string|array $characters
     * @return array
     */
    protected function moderateCharacters(string|array $characters): array
    {
        if(is_string($characters)) {
            $characters = str_split($characters);
        }

        $filteredCharacters = [];
        
        foreach($characters as $char) {
            if(is_numeric($char)) {
                $char = strval(abs(intval($char)));
            }

            if(is_string($char)) {
                if(strlen($char) !== 1) {
                    $charArray = str_split($char);
                    foreach($charArray as $char) {
                        $filteredCharacters[] = trim($char);
                    }
                    continue;
                }
                $filteredCharacters[] = trim($char);
            }
        }

        $filteredCharacters = array_filter($filteredCharacters, fn($char) => strlen($char) === 1);

        return array_values(array_unique($filteredCharacters));
    }
}