<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'feltet skal accepteres.',
    'accepted_if' => 'feltet skal accepteres når :other er :value.',
    'active_url' => 'feltet skal være en gyldig URL.',
    'after' => 'feltet skal være en dato efter :date.',
    'after_or_equal' => 'feltet skal være en dato efter eller lig med :date.',
    'alpha' => 'feltet må kun indeholde bogstaver.',
    'alpha_dash' => 'feltet må kun indeholde bogstaver, tal, bindestreger og understregninger.',
    'alpha_num' => 'feltet må kun indeholde bogstaver og tal.',
    'array' => 'feltet skal være et array.',
    'ascii' => 'feltet skal være et array.',
    'before' => 'feltet skal være en dato før :date.',
    'before_or_equal' => 'feltet skal være en dato før eller lig med :date.',
    'between' => [
        'array' => 'feltet skal være en dato før eller lig med :date.',
        'file' => 'feltet skal være mellem :min og :max kilobytes.',
        'numeric' => 'feltet skal være mellem :min og :max.',
        'string' => 'feltet skal være mellem :min og :max tegn.',
    ],
    'boolean' => 'feltet skal være sandt eller falsk.',
    'confirmed' => 'feltets bekræftelse stemmer ikke overens.',
    'current_password' => 'Adgangskoden er forkert.',
    'date' => 'feltet skal være en gyldig dato.',
    'date_equals' => 'feltet skal være en dato lig med :date.',
    'date_format' => 'feltet skal matche formatet :format.',
    'decimal' => 'feltet skal have :decimal decimaler.',
    'declined' => 'feltet skal være afvist.',
    'declined_if' => 'feltet skal være afvist når :other er :value.',
    'different' => 'feltet og :other skal være forskellige.',
    'digits' => 'feltet skal være :digits cifre.',
    'digits_between' => 'feltet skal være mellem :min og :max cifre.',
    'dimensions' => 'feltet har ugyldige billedmål.',
    'distinct' => 'feltet har en duplikatværdi.',
    'doesnt_end_with' => 'feltet må ikke ende med en af følgende: :values.',
    'doesnt_start_with' => 'feltet må ikke begynde med en af følgende: :values.',
    'email' => 'feltet skal være en gyldig e-mailadresse.',
    'ends_with' => 'feltet skal slutte med en af følgende: :values.',
    'enum' => 'Den valgte er ugyldig.',
    'exists' => 'Den valgte er ugyldig.',
    'file' => 'feltet skal være en fil.',
    'filled' => 'feltet skal have en værdi.',
    'gt' => [
        'array' => 'feltet skal have mere end :value elementer.',
        'file' => 'feltet skal være større end :value kilobytes.',
        'numeric' => 'feltet skal være større end :value.',
        'string' => 'feltet skal være større end :value tegn.',
    ],
    'gte' => [
        'array' => 'feltet skal have :value elementer eller mere.',
        'file' => 'feltet skal være større end eller lig med :value kilobytes.',
        'numeric' => 'feltet skal være større end eller lig med :value.',
        'string' => 'feltet skal være større end eller lig med :value tegn.',
    ],
    'image' => 'feltet skal være et billede.',
    'in' => 'Den valgte er ugyldig.',
    'in_array' => 'feltet skal eksistere i :other.',
    'integer' => 'feltet skal være et heltal.',
    'ip' => 'feltet skal være en gyldig IP-adresse.',
    'ipv4' => 'feltet skal være en gyldig IPv4-adresse.',
    'ipv6' => 'feltet skal være en gyldig IPv6-adresse.',
    'json' => 'feltet skal være en gyldig JSON-streng.',
    'lowercase' => 'feltet skal være med små bogstaver.',
    'lt' => [
        'array' => 'feltet skal have mindre end :value elementer.',
        'file' => 'feltet skal være mindre end :value kilobytes.',
        'numeric' => 'feltet skal være mindre end :value.',
        'string' => 'feltet skal være mindre end :value tegn.',
    ],
    'lte' => [
        'array' => 'feltet må ikke have mere end :value elementer.',
        'file' => 'feltet skal være mindre end eller lig med :value kilobytes.',
        'numeric' => 'feltet skal være mindre end eller lig med :value.',
        'string' => 'feltet skal være mindre end eller lig med :value tegn.',
    ],
    'mac_address' => 'feltet skal være en gyldig MAC-adresse.',
    'max' => [
        'array' => 'feltet må ikke have mere end :max elementer.',
        'file' => 'feltet må ikke være større end :max kilobytes.',
        'numeric' => 'feltet må ikke være større end :max.',
        'string' => 'feltet må ikke være større end :max tegn.',
    ],
    'max_digits' => 'feltet må ikke have mere end :max cifre.',
    'mimes' => 'feltet skal være en fil af typen: :values.',
    'mimetypes' => 'feltet skal være en fil af typen: :values.',
    'min' => [
        'array' => 'feltet skal have mindst :min elementer.',
        'file' => 'feltet skal være mindst :min kilobytes.',
        'numeric' => 'feltet skal være mindst :min.',
        'string' => 'feltet skal være mindst :min tegn.',
    ],
    'min_digits' => 'feltet skal have mindst :min cifre.',
    'missing' => 'feltet skal mangle.',
    'missing_if' => 'feltet skal mangle, når :other er :value.',
    'missing_unless' => 'feltet skal mangle, medmindre :other er :value.',
    'missing_with' => 'feltet skal mangle, når :values er til stede.',
    'missing_with_all' => 'feltet skal mangle, når :values er til stede.',
    'multiple_of' => 'feltet skal være et multiplum af :value.',
    'not_in' => 'Den valgte :attribute er ugyldig.',
    'not_regex' => 'feltformatet er ugyldigt.',
    'numeric' => 'feltet skal være et tal.',
    'password' => [
        'letters' => 'feltet skal indeholde mindst ét bogstav.',
        'mixed' => 'feltet skal indeholde mindst ét stort og ét lille bogstav.',
        'numbers' => 'feltet skal indeholde mindst ét nummer.',
        'symbols' => 'feltet skal indeholde mindst ét symbol.',
        'uncompromised' => 'Det givne :attribute er optrådt i et datalæk. Vælg venligst en anden :attribute.',
    ],
    'present' => 'feltet skal være til stede.',
    'prohibited' => 'feltet er forbudt.',
    'prohibited_if' => 'feltet er forbudt, når :other er :value.',
    'prohibited_unless' => 'feltet er forbudt, medmindre :other er i :values.',
    'prohibits' => 'feltet forhindrer :other i at være til stede.',
    'regex' => 'feltformatet er ugyldigt.',
    'required' => 'feltet er påkrævet.',
    'required_array_keys' => 'feltet skal indeholde indtastninger for: :values.',
    'required_if' => 'feltet er påkrævet, når :other er :value.',
    'required_if_accepted' => 'feltet er påkrævet, når :other accepteres.',
    'required_unless' => 'feltet er påkrævet, medmindre :other er i :values.',
    'required_with' => 'feltet er påkrævet, når :values er til stede.',
    'required_with_all' => 'feltet er påkrævet, når :values er til stede.',
    'required_without' => 'feltet er påkrævet, når :values ikke er til stede.',
    'required_without_all' => 'feltet er påkrævet, når ingen af :values er til stede.',
    'same' => 'feltet skal matche :other.',
    'size' => [
        'array' => 'feltet skal indeholde :size elementer.',
        'file' => 'feltet skal være :size kilobytes.',
        'numeric' => 'feltet skal være :size.',
        'string' => 'feltet skal være :size tegn.',
    ],
    'starts_with' => 'feltet skal starte med en af følgende: :values.',
    'string' => 'feltet skal være en streng.',
    'timezone' => 'feltet skal være en gyldig tidszone.',
    'unique' => 'Dette er allerede taget.',
    'uploaded' => 'mislykkedes med at uploade.',
    'uppercase' => 'feltet skal være med store bogstaver.',
    'url' => 'feltet skal være en gyldig URL.',
    'ulid' => 'feltet skal være en gyldig ULID.',
    'uuid' => 'feltet skal være en gyldig UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'brugerdefineret-besked',
        ],
        'username' => [
            'unique' => 'Dette :attribute er allerede taget.',
        ],
        'email' => [
            'unique' => 'Denne :attribute er allerede i brug.',
        ],
        'password' => [
            'confirmed' => 'De to felter med den nye :attribute stemmer ikke overens.',
        ],
        
    ],

    'numeric' => 'Feltet skal være et tal.',
    'required' => 'Dette felt skal udfyldes.',
    'accepted' => 'Feltet skal accepteres.',
    'at_least_one' => 'Du skal indsende mindst ét billede.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'navn',
        'username' => 'brugernavn',
        'password' => 'adgangskode',
        'current_password' => 'nuværende adgangskode',
        'email' => 'e-mail',
        'role' => 'rolle',
        'copyright_rule_id' => 'ophavsretsregel',
        'picture' => 'billede',
        'token' => 'token',
        'licence_id' => 'licens',
        'fossil_speciality_id' => 'fossil specialitet',
        'fossil_region_id' => 'fossil region',
        'description' => 'beskrivelse',
        'endpoint' => 'endepunkt',
        'resource_order' => 'ressourcerækkefølge',
        'new_order' => 'nyhedsrækkefølge',
        'html' => 'html',
        'county_id' => 'amt',
        'date_find' => 'dato finde',
    ],

];
