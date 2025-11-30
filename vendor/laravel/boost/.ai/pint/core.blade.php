<<<<<<< HEAD
@php
/** @var \Laravel\Boost\Install\GuidelineAssist $assist */
@endphp
## Laravel Pint Code Formatter

- You must run `{{ $assist->binCommand('pint') }} --dirty` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `{{ $assist->binCommand('pint') }} --test`, simply run `{{ $assist->binCommand('pint') }}` to fix any formatting issues.
=======
## Laravel Pint Code Formatter

- You must run `vendor/bin/pint --dirty` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint` to fix any formatting issues.
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
