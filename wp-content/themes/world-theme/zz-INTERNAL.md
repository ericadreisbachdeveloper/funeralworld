# Internal notes
###### current as of July 2021


## Set up Local Wordpress Build
1. Create a new database in phpMyAdmin http://localhost/phpMyAdmin/

2. Navigate to localhost installation diretory

3. `$ bower install wordpress`

4. `$ mv bower_components/wordpress/* .`

5. Run Wordpress installation

6. Delete all Wordpress themes in `wp-content/themes/` except for latest Wordpress theme



## Use /files/ instead of /wp-content
In `wp-config.php` ...

`if ( ! defined( 'ABSPATH' ) ) { define( 'ABSPATH', __DIR__ . '/XXXXX/' ); }` <br />
`define ('WP_CONTENT_FOLDERNAME', 'files');` <br />
`define( 'WP_CONTENT_DIR', ABSPATH . '/files' );` <br />
`define( 'WP_SITEURL', 'httpXXXX://' . $_SERVER['HTTP_HOST'] . '/XXXX/');` <br />
`define( 'WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME);`



## Set up Remote Server Environment
In the remote web host:

1. Create a secure FTP account

    - Upload Wordpress `wp-admin/*` and  `wp-includes/*` files to remote via FTP

    - Upload Wordpress root files to Wordpress location ...

      - ... but not `wp-config.php`
      - ... and not `.gitignore`
      - ... and not `.htaccess`

2. Create an SSH account on remote host

    - upload local `~\.ssh\id_rsa.pub` to remote host

      - grab SSH credentials from remote host

    - update local `~\.ssh\config` with remote SSH credentials: <br />
        `Host [SSH ALIAS]` <br />
        `Hostname XXXXX` <br />
        `User XXXX` <br />
        `Port XXXX`
    - confirm access to host `$ ssh [SSH ALIAS]`

    - note home directory location

3. Create a MySQL instance

    - create a database user if needed
    - create a database
    - give database user all privileges to database
    - make a note of

      - database username
      - database user password
      - database


## Set Up Git
1. Copy `[THEME]\zz-gitignore.txt` to `[LOCAL ROOT]` and rename `.gitignore`
    - `.gitignore` will be tracked

    - `wp-content/mu-plugins` and non-Wordpress themes in `wp-content\themes` folder will be tracked

    - ... but that's it; uploads and plugins must be transferred via FTP

2. Run `$ git init` in `[LOCAL ROOT]`

3. Run an initial commit

4. SSH into remote server; navigate one level higher than Wordpress install

    - `$ mkdir [ALIAS].git `
    - `$ cd [ALIAS.git]`
    - `$ git init --bare`
    - create `post-receive` file, the one that includes the contents of `$ pwd` <br />
     `$ cat > hooks/post-receive` <br />
      `#!/bin/sh` <br />
      `GIT_WORK_TREE=/var/www/www.example.org git checkout -f`  
    - use `control + d` to exit concatenate
    - `$ chmod +x hooks/post-receive`

###### src: http://toroid.org/ams/git-website-howto <br /><br />


5. On local, run <br />
`$ git remote add [ALIAS] [SSH ALIAS]:www/dev.git`  
    - `~` home directory is implied in `[SSH ALIAS]`)

6. `$ git push [ALIAS] +master:refs/heads/master`

7. Confirm that theme files pushed to remote




## Set Up Wordpress on Remote

You're ready to install Wordpress!

1. For obscure-secure, create a directory for Wordpress in `root`; can use a crazy string generated with  
https://www.random.org/strings/

2. Use FTP or scp to move Wordpress core files to remote

3. Use Git to move Wordpress theme files to remote (see **Set Up Git** above)

4. Use FTP or scp to move Wordpress upload files to remote

5. Create a MySQL instance and install Wordpress the regular way
https://wordpress.org/support/article/how-to-install-wordpress/

6. For obscure-secure, use FTP or command line to move `wp-config.php` one directory higher than Wordpress installation.

7. Use **WP Migrate DB Pro** or **phpmyadmin** to move local database to remote

8. Remove all database privileges except for `SELECT, INSERT, UPDATE, DELETE, DROP`



## Plugins
See `[THEME]/README.md`


## Create Screenshot
Recommended size: 1200px wide x 900px high

Save as `THEME\screenshot.jpg`

## Create Favicons
Save to `THEME\favicons\` :
- largetile.png (310x310)
- favicon-196.png
- favicon-180.png
- mediumtile.png (150x150)
- widetile.png (310x150)
- favicon-144.png
- favicon-32.png
- favicon-16.png
- favicon.svg


Create favicon.ico:

`$ convert favicon-16.png favicon-32.png favicon.ico`


Save to `[ROOT]\` :

- favicon.png - 32px x 32px
- favicon.ico - 32px x 32px AND 16px x 16px


###### src: https://github.com/audreyr/favicon-cheat-sheet


## Create Google App Data
Save to `[ROOT]\icons\` :
- favicon-32.png
- favicon-72.png
- favicon-144.png
- favicon-196.png

Save to `[ROOT]` :
- manifest.json

###### src: https://developer.chrome.com/apps/manifest



## Load Starter Data
Activate WP Migrate DB Pro under **Tools > Migrate DB Pro > Settings**

Import starter data in `theme/sql/STARTER-DATA-xxx.sql.gz` under **Tools > Migrate DB Pro > Import**



## Pages
1. Add

2. Change Sample Page to Home

3. Set Home as Front Page

4. Change Privacy Policy Order to 900

5. Create Login page with template Login with Order 900 and permalink `admin-login`

6. Set Kitchen Sink to order 999 and exclude from native Wordpress search

7. Create pages to populate the sitemap

8. Create the Main Menu and add to location Main Menu





## Social Media / Open Graph
1. In Advanced Custom Fields (**Custom Fields**) create the Field Group **Open Graph**

2. Create the image field `social-img` with the following description:
>Recommended size: 1048px wide x 548px high with focal point in the center.
>Image may be cropped by social media platforms.
>This image is the default image that will programmatically appear when the site is shared on social media.
>Featured Image for a given post or page will override this image.


## Meta Description
1. In Advanced Custom Fields (**Custom Fields**) create the Field Group **Search Appearance** and Text Area field **Meta Description**

2. Add the following description:
> Recommended: no more than 160 characters.
> This text usually appears as the snippet in web search results. &lt;br /&gt; &lt;br /&gt;
> NOTE: this snippet may be overridden by Google &lt;br /&gt; &lt;br /&gt;
> ALSO NOTE: Google does not use meta description keywords in search ranking &lt;a href=&quot;https://webmasters.googleblog.com/2007/12/answering-more-popular-picks-meta-tags.html&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt;[citation]&lt;/a&gt;


## Schema
???


## ImageMagick Command Line
1. Compress jpegs
`convert SAMPLE.jpg -sampling-factor 4:2:0 -quality 85 -interlace JPEG -colorspace RGB compressed/SAMPLE.jpg`

2. Manually convert `.jpg` to `.webp`
  `$ convert wizard.png -quality 50 -define webp:lossless=true wizard.webp`

More at https://imagemagick.org/script/webp.php


## ImageMagick on SiteGround
Create a `php.ini` with the line
`extension=imagick.so`
and add to `public_html` or other root directory.

Add to Wordpress installation `.htaccess`:
`# Imagick`
`SetEnv PHPRC [ FULL SERVER PATH ]/public_html/php.ini`


## Clear Persistent Object Cache  

Persistent object caching done with `object-cache.php`
More at https://github.com/l3rady/WordPress-APCu-Object-Cache

Clear this cache with
`$ wp cache flush`
More at https://developer.wordpress.org/cli/commands/cache/


## Clear Siteground Dynamic Cache
If using SiteGround plugin — is there a way to remove front end performance overhead ??
`$ wp sg purge`

src: https://www.siteground.com/kb/siteground-dynamic-caching-configuration/



## Compression + Security

`.htaccess` in `[ROOT]` or `wp-config.php` location:
- secure wp-config.php
- block xmprpc.php requests
- limit upload file types

`.htaccess` in Wordpress install directory
- add expire headers
- add cache-control headers
- turn off etags - https://web.dev/http-cache/#validating_cached_responses_with_etags
- add gZIP compression
- block xmprpc.php requests

`.htaccess` in `/wp-content/uploads`
- secure uploads from malicious file types
- whitelist jpg, gif, png, tif, pdf, svg, htaccess, webp


## Disallow back end file editor
In `wp-config.php` :

`define( 'DISALLOW_FILE_EDIT', true);`


## Disallow Add New Plugins from back end
In `wp-config.php` :

`define('DISALLOW_FILE_MODS', true);`


## Check for "FilesMan"


## Verify Wordpress Installation
From the CLI
`$ wp core verify-checksums `


# Theme Development Tools


## CSS
Autoprefixer: https://autoprefixer.github.io/



## Scripts

**preconnect defer** for theme-dependent scripts + analytics

**dns-prefetch async** for ads

### External scripts - when to use `preconnect` vs `dns-prefetch`
> The practical difference is hence, **if you know that a server fetch will happen for sure, preconnect is good**. If it will happen only sometimes, and you expect huge traffic, preconnect might trigger a lot of useless TCP and TLS work, and dns-prefetch might be a better fit.

#### src: https://stackoverflow.com/questions/47273743/preconnect-vs-dns-prefetch-resource-hints#:~:text=The%20practical%20difference%20is%20hence,might%20be%20a%20better%20fit.


### `defer` vs. `async` pt 1
> Just tell me the best way <br />
> The best thing to do to speed up your page loading when using scripts is to **put them in the head, and add a defer attribute** to your script tag

#### src: https://flaviocopes.com/javascript-async-defer/#just-tell-me-the-best-way


### `defer` vs. `async` pt 2
> Async scripts are great when we integrate an independent third-party script into the page: counters, ads and so on, as they don’t depend on our scripts, and our scripts shouldn’t wait for them

#### src: https://javascript.info/script-async-defer



## Images

The most powerful Wordpress image function of all time: `wp_prepare_attachment_for_js($img_id);`

`$img_js = wp_prepare_attachment_for_js($img_id);`
`$img = $img_js['sizes']['large']['url'];`
`$title = $img_js['title'];`
`$alt = $img_js['alt'];`



## Use wp_reset_postdata()
https://stackoverflow.com/questions/38595355/wp-reset-query-or-wp-reset-postdata

> You should never have to use `wp_reset_query()`, which is only used to restore $wp_query and global post data to the original main query when using query_posts() (which you should never use).

> Instead, you should only be using `wp_reset_postdata()` when you want to restore the global $post variable of the main query loop after a secondary query loop using new `WP_Query()`. You have used this correctly in your example.

... but `wp_reset_query()` **has** worked for resetting to page defaults on a page with a custom loop-in-page (i.e. so Edit This link works properly).

So don't erase `wp_reset_query()` from your brain entirely.



# Push Local to Remote
1. SFTP `wp-content/uploads/`
2. SFTP `wp-content/webp-express/`
3. ??? `wp-content/themes/THEME/acf-json` (during development only)
4. theme files via git
5. database via **WP Migrate DB Pro** or phpMyAdmin


# Recursively Delete  .DS_Store
`$ find . -name ".DS_Store" -delete`
