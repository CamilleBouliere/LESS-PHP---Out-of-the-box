# LESS PHP - Out of the box

Out of the box LESS compiler in PHP with sourcemaps and cache with Apache rewriting based on [oyejorge's less.php][compilerurl].

## Features

 - Parse LESS files
 - Holy sourcemaps
 - .htaccess based rewriting
 - Generates static *.css* files (so in production you can just copy the files or let the compiler live its life)
 - Cache
 - Dev/production different behaviour
 - Show errors in dev mode with a :before on body

## Instructions

 1. Copy everything on your server in the desired directory
 2. *css* and *css_cache* directories must be writable
 3. Open *yourserver/css/test.css* in your browser

You should see this :

```css
.box {
  color: #fe33ac;
  border-color: #fdcdea;
}
.box div {
  -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}
/*# sourceMappingURL=../css/test.map */
```

The script:

 1. has compiled *less/test.less* and shows it to you
 2. has created *css/test.css* and is NOT showing it to you
 3. has created *css/test.map* and you can see it in your dev tools
 4. has created somes files in *css_cache* : don't touch them

So, basicly you have to modify files inside *less/* directory and call your CSS the same way you call *.less* files. It's transparent and can be used with quite any CMS.

## What is nice ?

You know how to copy a file ? You know LESS ? You are ready! It's perfect for frontend developers who don't want to bother with backend.

## What is NOT nice ?

I'm not a back-end developer! I don't know shit about nice PHP coding rules. So, here you have my little tool, built to ease up my *coding* life. It mostly works well... but it's not optimized, there might be some errors and the production mode might be buggy.

## Known issues

Sometimes, for some reason, sourcemap seams to not work. Just refresh your browser.

## You prefer SASS ?

Check out [SASS-PHP---Out-of-the-box][sasscompiler].

[compilerurl]: https://github.com/oyejorge/less.php
[sasscompiler]: https://github.com/CamilleBouliere/SASS-PHP---Out-of-the-box
