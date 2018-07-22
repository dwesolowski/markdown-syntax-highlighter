# Markdown Syntax Highlighter for WordPress

Adds easy syntax highlighting for Markdown in WordPress with [Prism](https://prismjs.com/)

## Requirements

This is not intended to be a standalone plugin, you will also need the following plugins.

[Markdown Post Parser](https://github.com/dwesolowski/markdown-post-parser)  
[Markdown Text Buttons](https://github.com/dwesolowski/markdown-text-buttons)

## Prism Build

* Lang - markup
* Lang - css
* Lang - clike
* Lang - javascript
* Lang - bash
* Lang - markup emplating
* Lang - markdown
* Lang - php
* Lang - php xtras
* Plugin - command-line

## Features

Please see [Markdown syntax](https://www.markdownguide.org/cheat-sheet/) for reference.

* For inline highlighting surround  \`text to highlight\` with back-ticks

##### Result:

Inline `highlighting section` example

* For block highlighting use three \``` back-ticks followed by your language

##### Example:

<pre>
```javascript
var s = "JavaScript syntax highlighting";
alert(s);
```
</pre>

* For command prompt block highlighting as root use three \``` back-ticks followed by bash-root

##### Example:

<pre>
```bash-root
sudo apt update
```
</pre>

* For command prompt block highlighting as user use three \``` back-ticks followed by bash-user

##### Example:

<pre>
```bash-user
sudo apt update
```
</pre>

## Sample CSS to add to your theme CSS for inline code

```css
<style>
    :not(pre) > code {
        padding: .1em .4em .1em .4em;
        border: 1px solid #d4cfcf;
        border-radius: .3em;
        white-space: normal;
        color:#DD4A68;
        background: #eee;
        text-shadow: 0 1px white;
    }
    :not(pre) > code[class*="language-"],
    pre[class*="language-"] {
        background: #eee;
    }
</style>
```

## License

Markdown Syntax Highlighter is licensed under the GPLv3.
