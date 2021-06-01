<?php
if ($_SERVER['SERVER_PORT'] == '8080') :
    // Replace src paths
    add_filter('wp_get_attachment_url', function ($url) {
        if (file_exists($url)) :
            return $url;
        endif;
        return str_replace(WP_HOME, 'https://bikecleveland.org', $url);
    });

    // Replace srcset paths
    add_filter('wp_calculate_image_srcset', function ($sources) {
        foreach ($sources as &$source) {
            if (!file_exists($source['url'])) :
                $source['url'] = str_replace(WP_HOME, 'https://bikecleveland.org', $source['url']);
            endif;
        }
        return $sources;
    });
endif;

function wp_get_attachment_url_callback($url, $att_id)
{
    // Instead of keeping full path we actually need just 'wp-content/uploads'.
    // And we do this the right way, dynamically, calling functions and constants.
    $uploads_dir         = wp_get_upload_dir()['basedir'];
    $partial_uploads_dir = str_replace(ABSPATH, '', $uploads_dir);

    // Check if attachment file is in WordPress uploads directory.
    if (strpos($url, $partial_uploads_dir) === false) {
        return $url;
    }

    // Just for reference, until now, the $url is still something like:
    // http://example.com/wp-content/uploads/2019/03/image.jpg

    /**
     * @TODO    Define the right CDN URL here.
     */
    $new_site_url = 'http://bikecleveland.org';
    $pattern      = get_site_url();
    $url          = preg_replace("#$pattern#", $new_site_url, $url);

    // Again, just for reference, now the $url looks like:
    // http://cdn-domain.com/wp-content/uploads/2019/03/image.jpg

    return $url;
}

add_filter('wp_get_attachment_url', 'wp_get_attachment_url_callback', 999, 2);
