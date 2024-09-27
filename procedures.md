# Procedures

## Zipping files
Terminal
```
    zip -vr scml_a11y.zip scml_a11y/ -x "*.DS_Store"
```


This command will update an existing zip archive named "scml_a11y.zip" with the contents of the directory "scml_a11y/" while excluding files with the name pattern "*.DS_Store".

___
zip: This is the command used to create and manipulate zip archives.

-v: This flag tells zip to be verbose and print information about the files being added or updated.

-r: This flag tells zip to update an existing archive. If the archive doesn't exist, it will be created.

scml_a11y.zip: This is the name of the zip archive that will be updated.

scml_a11y/: This is the directory whose contents will be added to the archive.

-x "*.DS_Store": This option excludes files with the name pattern "*.DS_Store" from being added to the archive.