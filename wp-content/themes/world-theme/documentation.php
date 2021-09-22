<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<style type="text/css">
#doc {
  background: white;
  max-width: 55em;
  border: 1px solid #ddd;
  margin: 2em;
  padding: 2em;
}

#doc h1 { font-size: 2.4rem; }
#doc h2 { font-size: 1.8rem;  padding-top: .8em; }
#doc h3 { margin: 0; padding-top: 1em; }

#doc blockquote,
#doc p,
#doc ul,
#doc ol  { font-size: 1.1rem; }

#doc blockquote,
#doc p,
#doc ul,
#doc ol  { line-height: 1.666; }

#doc ul, #doc ol {
  margin-left: 2em;
  padding-left: 1em;
}

#doc ul {
  list-style-type: disc;
}

#doc ul li + li ,
#doc ol li + li {
  padding-top: .5rem;
}

#doc .-large { font-size: 1.2rem; }
#doc .-small { font-size: .95rem; }
#doc .-strong { font-weight: 700; }
</style>

<div id="doc">

<h1>Theme Documentation</h1>


<h2>Basic Wordpress Help </h2>
<p>Answers to many questions are available in the official Wordpress documentation: <a href="https://codex.wordpress.org/" target="_blank" rel="noopener">codex.wordpress.org</a> </p>


<h2>Duplicate Pages </h2>
<p>To clone an existing page, hover over the page name in the list under <strong>Pages&nbsp;&gt;&nbsp;All&nbsp;Pages</strong> and click <strong>Duplicate</strong> </p>

<h2>Backing Up the Database</h2>

<p>Export and save a .sql file of the database via <strong>Tools > Migrate DB Pro > BACK UP</strong></p>



<h2>Email Addresses </h2>

<p>This theme uses <strong>spamspan.js</strong> to prevent spammers and web crawlers from scraping email addresses from this site. To post a clickable email address hidden from spammers, add it in the <strong>Text</strong> view in the form <blockquote><span style="font-family: monospace;">&lt;span class="spamspan"&gt;&lt;span class="u"&gt;user&lt;/span&gt;[at]&lt;span class="d"&gt;website[dot]com&lt;/span&gt;&lt;/span&gt;</span></blockquote> <p>and the address will automatically turn into a clickable link on the front end.</p>



<h2>Wordpress Tips </h2>

<h3>Widows </h3>
<p>Avoid widows (single words at the start of a line) by adding a nonbreaking space between the last and second-to-last words. Switch to the <strong>Text</strong> tab and add the code <span style="font-family: monospace;">&amp;nbsp;</span> like so:</p>

<blockquote><span style="font-family: monospace;">...school&amp;nbsp;today.</span></blockquote>

<p>The nonbreaking space will be invisible from the <strong>Visual</strong> tab and on the front end. </p>




<h2>Plugins </h2>
<p>This theme relies on the following plugin(s):</p>

<ul>
  <li><a class="-large -strong" href="https://www.advancedcustomfields.com/pro/" target="_blank" rel="noopener">Advanced Custom Fields PRO</a><br />
    <em>Powers most custom templates</em><br />
    <a class="-small" href="https://wpscan.com/search?text=%22advanced%20custom%20fields%22" target="_blank" rel="noopener">Check Advanced Custom Fields in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Custom Fields </strong>
  </li>

  <li><strong class="-large">Gutenberg Blocks </strong><br />
    <em>Custom plugin that creates wrapper divs around Wordpress-generated content blocks to allow <span class="nowrap">full-width</span> and <span class="nowrap">within-container</span> Gutenberg block&nbsp;elements. </em>
  </li>
</ul>


<p>Additional plugin(s) installed for security and ease of development: </p>
<ul>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/acf-better-search/" target="_blank" rel="noopener">ACF Better Search</a><br />
    <em>Allows custom field content to appear in native Wordpress search&nbsp;results </em><br />
    <a class="-small" href="https://wpscan.com/search?text=%22acf%20better%20search%22" target="_blank" rel="noopener">Check ACF Better Search in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Settings > ACF Better Search</strong></li>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/google-sitemap-generator/" target="_blank" rel="noopener">Google XML Sitemaps</a><br />
    <em>Excellent tool for dynamically-generated sitemaps to improve search appearance </em> <br />
    <a class="-small" href="https://wpscan.com/search?text=%22Google%20XML%20Sitemaps%22" target="_blank" rel="noopener">Check Google XML Sitemaps in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Settings > XML Sitemap </strong>
  </li>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/hide-my-site/" target="_blank" rel="noopener">Hide My Site</a><br />
    <em>Hides and secures page during <span class="white-space: nowrap;">non-public</span> phase of&nbsp;development. </em><br />
    <a class="-small" href="https://wpscan.com/search?text=%22hide%20my%20site%22" target="_blank" rel="noopener">Check Hide My Site in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Settings > Hide My Site </strong>
  </li>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/lazysizes/" target="_blank" rel="noopener">Lazysizes</a> <br />
    <em>Defers loading offscreen images, improving mobile page load time. </em><br />
    <a class="-small" href="https://wpscan.com/search?text=lazysizes" target="_blank" rel="noopener">Check Lazysizes in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Settings > Lazysizes </strong>
  </li>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/limit-login-attempts-reloaded/" target="_blank" rel="noopener">Limit Login Attempts Reloaded</a> <br />
  <em>Prevents brute force attacks to the site. </em><br />
  <a class="-small" href="https://wpscan.com/search?text=%22limit%20login%20attempts%20reloaded%22" target="_blank" rel="noopener">Check Limit Login Attempts Reloaded in the Wordpress Vulnerability Database&nbsp;></a> <br />
  <strong class="-small">Change settings in: Settings > Limit Login Attempts </strong></li>


  <li><a class="-large -strong" href="https://wordpress.org/plugins/mailchimp-for-wp/" target="_blank" rel="noopener">Mailchimp for Wordpress</a> <br />
    <em>Powers enewsletter signup.</em> <br />
    <a class="-small" href="https://wpscan.com/search?text=%22mailchimp%20for%20wordpress%22" target="_blank" rel="noopener">Check Mailchimp for Wordpress in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: MC4WP</strong>
  </li>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/quick-pagepost-redirect-plugin/" target="_blank" rel="noopener">Quick Page/Post Redirect Plugin</a><br />
    <em>Allows easy 301 redirects from previous generation of the site to the current&nbsp;site. </em> <br />
    <a class="-small" href="https://wpscan.com/search?text=%22quick%20page%2Fpost%20redirect%22" target="_blank" rel="noopener">Check Quick Page/Post Redirect in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Quick Redirects </strong>
  </li>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/svg-support/" target="_blank" rel="noopener">SVG Support</a><br />
    <em>Allows vector SVG files uploaded to the Wordpress media library, allowing crystal clear retina&nbsp;display. </em><br />
    <a class="-small" href="https://wpscan.com/search?text=%22svg%20support%22" target="_blank" rel="noopener">Check SVG Support in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Settings > SVG Support </strong>
  </li>

  <li><a class="-large -strong"href="https://wordpress.org/plugins/wpforms-lite/" target="_blank" rel="noopener">WPForms</a><br />
    <em>Powers Contact form. </em><br />
    <a class="-small" href="https://wpscan.com/search?text=%22wpforms%22" target="blank" rel="noopener">Check WPForms in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: WPForms</strong>
  </li>

  <li><a class="-large -strong" href="https://wordpress.org/plugins/webp-express/" target="_blank" rel="noopener">WebP Express</a> <br />
    <em>Allows images to be served in the <span style="white-space: nowrap">next-gen</span> .webp format, improving page&nbsp;speed. </em> <br />
    <a class="-small" href="https://wpscan.com/search?text=%22webp%20express%22" target="_blank" rel="noopener">Check WebP Express in the Wordpress Vulnerability Database&nbsp;></a> <br />
    <strong class="-small">Change settings in: Settings > WebP Express </strong>
  </li>

  <li><a class="-large -strong" href="https://deliciousbrains.com/wp-migrate-db-pro/" target="_blank" rel="noopener">WP Migrate DB Pro</a> <br />
  <em>Easy database backups and migration. </em><br />
  <a class="-small" href="https://wpscan.com/search?text=%22wp%20migrate%20db%22" target="_blank" rel="noopener">Check WP Migrate DB in the Wordpress Vulnerability Database&nbsp;></a> <br />
  <strong class="-small">Change settings in: Tools > Migrage DB Pro </strong></li>
</ul>



</div>
