# Media Player Filter for Moodle #

## Current version ##

alpha-1.1

## Features ##
- Display a responsive Media Player (Youtube, Dailymotion, Vimeo, and UPVD Stream)

## Supported languages ##
- english
- french

## Installation ##

Copy files into the following directory **/filter/miroplayer/** and visit **/admin/index.php** in your browser

## Requirement ##

Moodle 3.1 or greater / Bootstrap 4

## Usage ##

[player video="{string}" title="{string}" ratio="{16by9 | 4by3 | 21by9 | 1by1}"]

example :

[player video="upvdstream-mooc" title="Video Adobe Media Server" ratio="16by9"]

[player video="mediaserver-v1261891744e4jie903a" title="Video UPVD Media Server" ratio="16by9"]

[player video="youtube-Bq6IuZIJhuI" title="Video Youtube" ratio="16by9"]

[player video="dailymotion-x3drhcb" title="Video Dailymotion" ratio="16by9"]

[player video="vimeo-75266011" title="Video Vimeo" ratio="16by9"]

## Licence ##

Released under the [MIT Licence](https://opensource.org/licenses/MIT)
