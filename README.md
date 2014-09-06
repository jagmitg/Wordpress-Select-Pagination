Wordpress Pagination Plugin
=======

Wordpress Pagination is a simple pagination plugin, providing users with a more usable pagination on their site. 

This will increase the user experience from the traditional "Newer" or "Older" pagination that wordpress provides. Plus, this will increase the SEO level as well by providing multiple links for content.

Configuration
-----------
Pagination type is at 2 levels, 0 = select option (requires jquery within the txt file) and 1 = normal generic links.
```sh
$paginationType = 1;
```
Pagination Previous and Next element will only work if the pagination type is set to 0.
```sh
$prevnext = true;
```
Select the middle size where the paginate_link function will insert a '...'. Also, if you dont want it to work, place it to something impossible i.e 1000.
```sh
$middleSize = 4;
```
If paginationType = 0, you can insert the number of pages next to the select.
```sh
$totalPageNumber = true;
```

License
-----------

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.