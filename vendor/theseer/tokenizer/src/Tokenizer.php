<?php declare(strict_types = 1);
namespace TheSeer\Tokenizer;

class Tokenizer {

    /**
     * Token Map for "non-tokens"
     *
     * @var array
     */
<<<<<<< HEAD
    private const MAP = [
=======
    private $map = [
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        '(' => 'T_OPEN_BRACKET',
        ')' => 'T_CLOSE_BRACKET',
        '[' => 'T_OPEN_SQUARE',
        ']' => 'T_CLOSE_SQUARE',
        '{' => 'T_OPEN_CURLY',
        '}' => 'T_CLOSE_CURLY',
        ';' => 'T_SEMICOLON',
        '.' => 'T_DOT',
        ',' => 'T_COMMA',
        '=' => 'T_EQUAL',
        '<' => 'T_LT',
        '>' => 'T_GT',
        '+' => 'T_PLUS',
        '-' => 'T_MINUS',
        '*' => 'T_MULT',
        '/' => 'T_DIV',
        '?' => 'T_QUESTION_MARK',
        '!' => 'T_EXCLAMATION_MARK',
        ':' => 'T_COLON',
        '"' => 'T_DOUBLE_QUOTES',
        '@' => 'T_AT',
        '&' => 'T_AMPERSAND',
        '%' => 'T_PERCENT',
        '|' => 'T_PIPE',
        '$' => 'T_DOLLAR',
        '^' => 'T_CARET',
        '~' => 'T_TILDE',
        '`' => 'T_BACKTICK'
    ];

    public function parse(string $source): TokenCollection {
        $result = new TokenCollection();

        if ($source === '') {
            return $result;
        }

        $tokens = \token_get_all($source);

        $lastToken = new Token(
            $tokens[0][2],
            'Placeholder',
            ''
        );

        foreach ($tokens as $pos => $tok) {
            if (\is_string($tok)) {
                $token = new Token(
                    $lastToken->getLine(),
<<<<<<< HEAD
                    self::MAP[$tok],
=======
                    $this->map[$tok],
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                    $tok
                );
                $result->addToken($token);
                $lastToken = $token;

                continue;
            }

            $line   = $tok[2];
            $values = \preg_split('/\R+/Uu', $tok[1]);

            if (!$values) {
                $result->addToken(
                    new Token(
                        $line,
                        \token_name($tok[0]),
                        '{binary data}'
                    )
                );

                continue;
            }

            foreach ($values as $v) {
                $token = new Token(
                    $line,
                    \token_name($tok[0]),
                    $v
                );
                $lastToken = $token;
                $line++;

                if ($v === '') {
                    continue;
                }

                $result->addToken($token);
            }
        }

        return $this->fillBlanks($result, $lastToken->getLine());
    }

    private function fillBlanks(TokenCollection $tokens, int $maxLine): TokenCollection {
        $prev = new Token(
            0,
            'Placeholder',
            ''
        );

        $final = new TokenCollection();
<<<<<<< HEAD
        $prevLine = $prev->getLine();

        foreach ($tokens as $token) {
            $line = $token->getLine();
            $gap = $line - $prevLine;

            while ($gap > 1) {
                $linebreak = new Token(
                    $prevLine + 1,
=======

        foreach ($tokens as $token) {
            $gap = $token->getLine() - $prev->getLine();

            while ($gap > 1) {
                $linebreak = new Token(
                    $prev->getLine() + 1,
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                    'T_WHITESPACE',
                    ''
                );
                $final->addToken($linebreak);
<<<<<<< HEAD
                $prevLine = $linebreak->getLine();
=======
                $prev = $linebreak;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                $gap--;
            }

            $final->addToken($token);
<<<<<<< HEAD
            $prevLine = $line;
        }

        $gap = $maxLine - $prevLine;

        while ($gap > 0) {
            $linebreak = new Token(
                $prevLine + 1,
=======
            $prev = $token;
        }

        $gap = $maxLine - $prev->getLine();

        while ($gap > 0) {
            $linebreak = new Token(
                $prev->getLine() + 1,
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                'T_WHITESPACE',
                ''
            );
            $final->addToken($linebreak);
<<<<<<< HEAD
            $prevLine = $linebreak->getLine();
=======
            $prev = $linebreak;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            $gap--;
        }

        return $final;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
