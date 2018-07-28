<?php
/**
 * Plugin Name: Markdown Syntax Highlighter
 * Plugin URI:
 * Description: Adds easy syntax highlighting for Markdown in WordPress with Prism
 * Version: 1.0
 * Author: Daren Wesolowski
 * Author URI:
 * License:     GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * Copyright (C) 2018  Daren Wesolowski
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // exit if accessed directly!
}

define( 'PLUGINVERSION', '1.0.0' );
define( 'PRISMJSVERSION', '1.15.0' );

class MarkdownSyntaxHighlighter {

    public function __construct() {

        add_action( 'init', array( $this,'register_assets' ) );
        add_filter( 'the_content', array( $this,'prism_content_filter' ), 99 );
        add_filter( 'comment_text', array( $this,'prism_content_filter' ), 99 );
    }

    public function register_assets() {

        wp_register_style( 'prismCSS', plugins_url( '/assets/prism/css/prism.css', __FILE__ ), array(), null );
        wp_register_script( 'prismJS', plugins_url( '/assets/prism/js/prism.js', __FILE__ ), array(), PRISMJSVERSION, true );
    }

    public function prism_content_filter( $content ) {

        $search = '@<pre><code(?: class="([\w-]+)")?>@';
        $count = 0;

        $content = preg_replace_callback( $search, function ( $matches ) {
            if ( isset( $matches[1] ) ) {
                if ( $matches[1] == 'language-bash-root' ) {
                    return '<pre class="command-line language-bash" data-prompt="#" data-user="" data-host=""><code class="language-bash">';

                } elseif ( $matches[1] == 'language-bash-user' ) {
                    return '<pre class="command-line language-bash" data-prompt="$" data-user="" data-host=""><code class="language-bash">';

                } elseif ( $matches[1] == 'language-bash-mysql' ) {
                    return '<pre class="command-line language-bash" data-prompt="mysql>" data-user="" data-host=""><code class="language-bash">';

                } else {
                    return sprintf( '<pre><code class="%s">', $matches[1] );
                }
            } else {
                return '<pre><code class="language-none">';
            }
        }, $content, -1, $count );

        if ( $count ) {
            wp_enqueue_style( 'prismCSS' );
            wp_enqueue_script( 'prismJS' );
        }
        return $content;
    }
}

$markdown_syntax_highlighter = new MarkdownSyntaxHighlighter();
