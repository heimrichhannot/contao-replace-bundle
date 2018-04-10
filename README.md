# Contao Replace Bundle

![](https://img.shields.io/packagist/v/heimrichhannot/contao-replace-bundle.svg)
![](https://img.shields.io/packagist/dt/heimrichhannot/contao-replace-bundle.svg)
[![](https://img.shields.io/travis/heimrichhannot/contao-replace-bundle/master.svg)](https://travis-ci.org/heimrichhannot/contao-replace-bundle/)
[![](https://img.shields.io/coveralls/heimrichhannot/contao-replace-bundle/master.svg)](https://coveralls.io/github/heimrichhannot/contao-replace-bundle)

Helper contao bundle to perform a regular expression search and replace on front end page.

## Configuration

Currently it is only possible to search and replace globally. Open your contao settings and configure custom search and replace patterns.

![Contao settings](src/Resources/doc/replace-settings.png)

## Examples

### Wrap headline text in `<span>`

Before: `<h1>Test A</h1>` 
After: `<h1><span>Test A<span></h1>`

- Pattern: `(<h\d[^>]*>)(.*)(<\/h[^>]*>)`
- Replacement: `$1<span>$2</span>$3`

### Bootstrap 4 responsive tables

Before: `<table><thead><tr><th>Value</th></tr></thead><tbody><tr><td>1</td></tr></tbody></table></body></html>` 
After: `<div class="table-responsive"><table class="table table-bordered table-hover"><thead><tr><th>Value</th></tr></thead><tbody><tr><td>1</td></tr></tbody></table></div>`

- Pattern: `(<table>)(.*)(<\/table>)`
- Replacement: `<div class="table-responsive"><table class="table table-bordered table-hover">$2</table></div>`

### Replace files path inside links

Before: `<a href="tl_files/subfolder/files/file.pdf">Test link</a>` 
After: `<a href="files/backup/file.pdf">Test link</a>`

- Pattern: `(tl_files\/subfolder\/files\/)`
- Replacement: `<div class="table-responsive"><table class="table table-bordered table-hover">$2</table></div>`
- Replace tags: true (checked)