<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style-type: none;
  text-decoration: none;
  background-repeat: no-repeat;
  z-index: 1;
}
h1,
h2,
h3,
h4,
p,
a {
  font-family: "Comfortaa", sans-serif;
}
html{
  overflow-x: hidden;
}
:root {
  --main-bg-color: #272525;
  --second-bg-color: #332f2f;
  --second-color: #5EC7DE;
  --main-txt-color: #e5e5e5;
  --second-txt-color: #ffffff;
  --in-input-txt-color: #959595;
  --another-txt-color: #cbcbcb;
}
body {
  background-color: var(--main-bg-color);
}
.container {
  width: 1560px;
  margin: 0 auto;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding-top: 25px;
}
@media screen and (max-width: 420px){
  .container {
  width: 100vw;
  margin: 0 auto;
}
main{
  width: 100%;
}
}
        </style>
        @vite('resources/css/app.css')
    </head>
    <body id="app" class="container">
        @vite('resources/js/app.js')
    </body>
</html>
