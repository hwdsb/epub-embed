# ePub Embed #

ePub Embed is a WordPress plugin, allowing you to upload and embed eBooks in the ePub format into your blog posts.

**Recommended:** Install the [Shortcake](https://wordpress.org/plugins/shortcode-ui/) plugin to get instant ePub previews in the WordPress editor.

This plugin was developed for the [Hamilton-Wentworth District School Board Commons](http://commons.hwdsb.on.ca).  Licensed under the GPLv2 or later.

***

### How to Use

1. Activate the plugin.
2. Create or edit a post.  Click on the "Add Media" button.
3. Upload an ePub file and click on the "Insert to Post" button.
4. If you installed the Shortcake plugin, you'll see the ePub in the post editor.  If not, you'll see an `[epub]` shortcode.  To customize the shortcode, view the "Shortcode parameters" section below.

### Shortcode parameters

The following are some custom parameters you can use with the shortcode:

* "width" - By default, this tries to use your theme's content width. If this doesn't exist, the width is "100%". Fill in this value to enter a custom width.

* "height" - Enter in a custom height for your ePub file if desired. Defaults to "700". Avoid percentages.

* "downloadlink" - By default, shows a download link after the ePub viewer.  Set to "false" to disable this.

### Notes

- If your WordPress media files are uploaded to the cloud, you'll need to ensure that you configure your bucket to handle CORS correctly.
- Embedding ePub files with rich media is not 100% accurate.  If you must embed ePubs with rich media, ensure that the format is supported on most browsers and ePub readers.  For example, for audio, use MP3 instead of M4A.
- Try to keep the size of the ePub as low as possible, since the entire ePub must be downloaded for processing and embedding.

### Thanks

* [Readium JS Viewer](https://github.com/readium/readium-js-viewer) - Used for rendering ePub files for embedding. Licensed under the [BSD-3-Clause](https://github.com/readium/readium-js-viewer/blob/master/license.txt).