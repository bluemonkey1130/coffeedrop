##Introduction
This is a wordpress theme to fulfil the requirements of the brief laid out in https://github.com/imageplus/CoffeeDropWebChallenge. the live site is hosted here https://coffeedrop.georgehawthorne.co.uk/


## Structure & Styling
I've leveraged some layouts from [**every layout**](https://every-layout.dev/) & combined with my own grid based styling. The idea is to create powerful CSS that is scalable and fast to write.
A interesting part of this project is using SCSS @each to create utility classes, which is used to rapidly create utility classes based on CSS variables.

**Pages are built upon the idea of grid rows, with the structure shown below.** The styling is based on a 14 column grid, row can be placed anywhere on the grid, the 12 inner columns have a fixed width, the two gutter columns on the edges of the page spread as far as needed.
````html
<article class="grid-row"> 
    <section class="grid"><!-- automatic column number -->
        <div><!-- --></div> 
        <div><!-- --></div>  
        <div><!-- --></div>  
    </section>
</article>
```` 
Any HTML elements can be used with the same class set up
````html
<header class="grid-row"> 
    <nav class="grid">
        <address><!-- --></address> 
        <video><!-- --></video>  
        <div><!-- --></div>  
    </nav>
</header>
```` 
Successive rows can be used to create whole pages
```html
<article class="grid-row">
    <section id="title" class="grid"> <!-- One Column -->
        <div><!-- --></div> 
    </section>
    <section id="text" class="grid"> <!-- Two Columns -->
        <figure><!-- --></figure> 
        <div><!-- --></div>  
    </section>
    <section id="gallery" class="grid"> <!-- Four Columns -->
        <figure><!-- --></figure> 
        <figure><!-- --></figure> 
        <figure><!-- --></figure> 
        <figure><!-- --></figure> 
    </section>
</article>
```
`.grid-row` is a wrapper for as many `.grid` elements as you want. Each `.grid` element can be set to a different widths: `standard`, `alignwide`, `alignfull` & `narrow`.

In this image you can see the different widths: the top row is `.align-full`, the second row is `.align-wide` and the bottom row is aligned to the `.standard` width

![image of grid colmns](twelve-column.png "shows the three ")

This approach allows flexibility when building up pages with combinations of coloured backgrounds and different margins.
```scss
  .grid-row {
    align-items: stretch;
    display: grid;
    grid-auto-flow: dense;
    grid-auto-rows: minmax(min-content, max-content);
    grid-template-columns: [full-start] minmax(calc(calc(100% - 1500px) / 2), 1fr) [main-start] repeat(12, [col-start] 1fr) [main-end] minmax(calc(calc(100% - 1500px) / 2), 1fr) [full-end];
    grid-template-rows: auto;
    margin: 0 auto var(--gridsize) auto;
    max-width: calc(var(--measure) * 5);
    position: relative;
  }
```
This CSS grid applied to `.grid-row` is a 14 column grid, 12 have a fixed width, and the two outermost spread to as large a possible. This is used control the `.grid` width options:
```scss
.narrow { 
  grid-column-start: 4;
  grid-column-end: 12;
}
.standard { // Declared as the default, no need to declare the class
  grid-column-start: 3;
  grid-column-end: 13;
}
.align-wide {
  grid-column-start: 2;
  grid-column-end: 14;
}
.align-full {
  grid-column-start: 1;
  grid-column-end: 15;
}
```
By default, they are set to the `standard` width, which doesn't need to be declared
```html
<article class="grid-row">
    <section class="grid">
        <div><!-- --></div> 
        <div><!-- --></div>  
        <div><!-- --></div>
    </section>
    <section class="grid align-wide">
        <div><!-- --></div> 
        <div><!-- --></div>  
        <div><!-- --></div>
    </section>
    <section class="grid align-full">
        <div><!-- --></div> 
        <div><!-- --></div>  
        <div><!-- --></div>
    </section>
</article>
```
`.grid-row`'s can be separated out to allow for further separation when wanting to apply different background colours or images that should span full width
```html
<article>
    <section class="grid-row bg-primary">
        <div class="grid align-wide">
            <div><!-- --></div> 
            <div><!-- --></div>  
        </div>
    </section>
    <section class="grid-row">
        <div class="grid">
            <div><!-- --></div> 
            <div><!-- --></div>  
        </div>
    </section>
    <section class="grid-row bg-primary">
        <div class="grid align-wide">
            <div><!-- --></div> 
            <div><!-- --></div>  
        </div>
    </section>
</article>
```
---
### ``grid``
The `.grid` inside of the `.grid-row` automatically sets the column number to match the number of child elements with a minimum width of 250px
````scss    
grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
````
```html
<article class="grid-row">
    <section class="grid"> 
        <div><!-- --></div> 
        <div><!-- --></div> 
    </section>
</article>
```
These classes can be used to alter the minimum block width like below, the default is ``250px``
```scss
.tiny-blocks / 10px;
.small-blocks / 200px;
.default-blocks / 250px; // the default, no need to declare 
.medium-blocks / 350px;
.large-blocks / 450px;
```
### ``grid-layout``
Whereas the `.grid-layout` class, which can be used in the place of `.grid` will allow you to set fixed column structures, such as:
```html
<article class="grid-row">
    <section class="grid-layout"> <!-- By default it will set up one column -->
        <div><!-- --></div> 
    </section>
</article>
```
These classes can be used to enforce column structures like below
```scss
.has-one-column
.has-two-columns
.has-three-columns
.has-four-columns
.has-five-columns
.has-six-columns
```
```html
<article class="grid-row">
    <section class="grid-layout has-two-columns"> 
        <div><!-- --></div> 
        <div><!-- --></div> 
    </section>
</article>
```
Some of these layouts have modifier classes to adjust the ratios of the column structure
```html
<article class="grid-row">
    <section class="grid-layout has-two-columns"> 
        <div><!-- --></div> 
        <div><!-- --></div> 
    </section>
    <section class="grid-layout has-two-columns left-wide"> 
        <div><!-- --></div> 
        <div><!-- --></div> 
    </section>
    <section class="grid-layout has-two-columns right-wide"> 
        <div><!-- --></div> 
        <div><!-- --></div> 
    </section>
</article>
```
It will enforce the column layout regardless of the number of child elements.
```html
<article class="grid-row">
    <section class="grid-layout has-three-columns">  <!-- Still three columns -->
        <div><!-- --></div> 
        <div><!-- --></div> 
        <div><!-- --></div> 
        <div><!-- --></div> 
        <div><!-- --></div> 
        <div><!-- --></div> 
    </section>
</article>
```