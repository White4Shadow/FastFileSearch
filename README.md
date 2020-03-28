# FastFileSearch

Fast FileSearch for Linux Servers using Linux grep and PHP7

## Getting Started

FastFileSearch can be adapted and operated via the web interface (currently only for JSON documents), which uses grep to make file searches for large amounts of data faster and easier.

### Prerequisites

Please note that FastFileSearch currently only works on Linux servers.

### Installing

* Download and upload files to your Server. 
* Access the installer
```
https://www.yourdomain.com/installer/
```
* Go through the steps. Make sure you set right permissions to make your Database accessible.
* After completing all steps, you can log in as administrator and set up the search system.

## Examples

##### Example JSON
```
{
    "metadata": {
        "title": "Paul Gerhardts sämtliche Lieder",
        "year": "1906",
    },
    "content": {
        "Vorwort": "Mein Trost, mein Schatz, mein Licht und Heil"
    }
}
```

##### Kategorie: 
* metadata
* content
##### Feld: 
* title -> Kategorie: metadata
* year  -> Kategorie: metadata

#### Searchqueries (selecting content)
###### find all files including "Trost" in content

```
Trost  
```
###### find all files including "Trost" AND "Licht" in content 

```
Trost "AND" Licht  
```

###### find all files including "Trost" OR "Licht" in content 

```
Trost "OR" Licht  
```

###### find all files NOT including "Licht" in content 

```
"NOT" Licht  
```
#### Searchqueries (selecting year)
###### find all files where year in RANGE

```
1900 "RANGE" 1910

OR

1910 "RANGE" 1900
```


### Demo
```
https://filesearch.blacktek.de/
```
* Administrator: admin, password: 0000
* User: testuser, password: 0000 

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
