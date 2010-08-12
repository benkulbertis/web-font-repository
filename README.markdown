Web Font Repository
===================

## License:

Copyright Ben Kulbertis

Dual licensed under MIT and GPL

## Description:

Writing out @font-face declarations can be tiring and annoying, especially if you are using a lot of them. With this software, you can create all the declarations once, and then use them on all your sites
as if they were web safe fonts. It has a built in http refferer authentication system, so the only sites that can use the fonts are ones that you specify.

## Installation:

  1. Optimally create a subdomain called fonts.yourdomain.com or something like that, you can however create a subdirectory if you wish.
  2. Upload the "fonts" directory as well as the index.php and default.html files.
  3. Rename the "fonts" directory to something difficult to guess, you don't have to remember it so make it gibberish. LEAVE THE TRAILING SLASH.
  4. Open index.php and change "fonts" on line 4 to the same thing you just renamed the fonts directory to.
  5. Change "http://example.com/" on line 15 and "http://another-example.org/" on line 16 to websites you wish to allow to use the repository's fonts. Add more lines as needed.Make sure one of them is the domain that the repository is hosted on.
  6. Open font-face.css and run a find and replace all with your text editor, replacing "http://example.com/" with your domain, be sure it begins with "http://" and has a trailing slash.
  7. Add `<link rel="stylesheet" href="http://**repository-location**/?file=font-face.css" type="text/css" />` to all the allowed domains.
  8. Use any of the fonts in the repository freely on any of the allowed sites as if they were web safe, they will work automatically. No need for any more @font-face declarations!
  9. Optionally change the look of the default.html page or remove line 41 from index.php. This exists so that if someone visits the repository location without a `$_GET['file']`, they will see something other than a white screen.

## Adding More Fonts:

  1. Create a folder called the font name in the "secret directory" previously called "fonts".
  2. Place the font files in the folder, optimally a .woff, .ttf, .eot, and .svg.
  3. Open the font-face.css file and add the following:
	
	@font-face {
	  font-family: 'Font-Name';
	  src: url('http://repository-location/?file=font-dir/font-file.eot');
	  src: local('☺'), url('http://repository-location/?file=font-dir/font-file.woff') format('woff'), url('http://repository-location/?file=font-dir/font-file.ttf') format('truetype'), url('http://repository-location/?file=font-dir/font-file.svg#the-svg-id') format('svg');
	  font-weight: normal;
	  font-style: normal;
	}

  4. Edit in the correct information to the @font-face declaration, changing the "font-family" name, the "repository-location" for each, the "font-dir" for each, the "font-file" for each, and the svg id at the end of the svg url.
  5. Use your new font!

## Attribution:

Some code is borrowed from "[How To Prevent Hotlinking With PHP](http://safalra.com/programming/php/prevent-hotlinking/)" for the domain authentication.

## More Help/Questions:

[ben@kulbertis.org](mailto:ben@kulbertis.org)