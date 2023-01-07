# CommentSold Code Challange

## SETUP 

### Dependencies
* PHP 8.2
* MySql8.0
* Node 16.14.0
* npm 8.5.1
* MySqlWorkbench (or any db administration tool that can create tables with csv files)

### Database setup
* created a user called appUser
* gave it a pass (you can use the example.env values if you so choose, or change them)
* used the MySqlWorkbench CSV import wizard to create and import tables and data (inventory.csv, users.csv, products.csv and inventory.ccsv ar all in the project data directory)

### App setup and serv

From a terminal in the project directory
* run ```composer install```
* run ```npm run build && npm run dev```
* ctrl+c to terminate the dev run as it just builds assets in this case

### Running the app
* run ```php artisan serve```  from the project directory

## Features
All features are tied to the user that is logged in and no products, inventory, or orders from other users 

# Authenticated login
* You can login as any of the provided users
* The user is persisted until logged out

# Products
* shows a list of products 20 at a time
* groups skus 

# Inventory
* Shows list of inventory 20 at a time
* Shows a count of all inventory items
* Allows filtering by product id
* Navigation respects the filters

# Orders
* Shows list of orders is 20 at a time
* They can be filterd by SKU or product name
* Bavigation respects the filters
* Totals and Average Totals are provided and respect the filters
* Filters are partail. (e.g. entering Lagenlook  will return Lagenlook Dungarees, Lagenlook Socks, Lagenlook Tie, etc)

# BUGS / TECH DEBT
* Filters cause a trailing & in the url when navigating.  This is visual only
* Some extra code is probably present because of setting up vue via artisan command.
* Vue setup did not take so blade files were used instead (This was outside of my confort zone anyways)
* Having to run ```npm run dev``` on a cold start is a bit annoying, having working vue installation wold solve this
* 






