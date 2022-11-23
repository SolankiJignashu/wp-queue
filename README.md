=== WordPress Queue ===
Contributors:      Jignashu Solanki
Tags:              Queue
Tested up to:      6.0
Stable tag:        1.0.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

WordPress Queue Mechanism for handing jobs in queue manner.

== Description ==

This plugin allows you to create queue job and execute that job in FIFO manner. 

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Changelog ==

= 1.0.0 =
* Release

== Example to Create New Job == 
1. Copy `class-whj-http-requests.php` file and add new file with new class name.
2. Add `__construct()` and `handle()` function for doing job task.
3. Create similar `whj_remote_post_job()` function which is in `helpers.php` file to add Job in Queue.