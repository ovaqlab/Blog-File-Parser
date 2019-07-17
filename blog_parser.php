<?php
/**
 * This parser parse the file contents from the set of blog files and return as a json array
 * @author Jithin Vijayan
 */

//Set document root to find the blog files
$documentRoot = "/Library/WebServer/Documents/test/";
//Specifying folder name which contain blog files
$targetDirectory = $documentRoot . "blogs";
//Scanning all the blog files from the given directory
$blogFiles = array_diff(scandir($targetDirectory), ['..', '.', '.DS_Store']);
$blogs = [];
// Reading each blog file contents
foreach ($blogFiles as $blogFile) {
    $fileName = $targetDirectory . "/" . $blogFile;
    //Removing directories from specified target locations if exists.
    if (is_dir($fileName)) {
        continue;
    }

    //this parser will fetch only the files with extension .md & .txt
    $fileExtension = ltrim(strstr($blogFile, '.'), '.');

    if ($fileExtension !== "md" && $fileExtension !== "txt") {
        continue;
    }
    //Fetching file contents as a string
    $fileContents = file_get_contents($fileName);
    //Extracting meta data from file contents
    $fileSections = preg_split("/(---)/", $fileContents);
    $metaDataSection = $fileSections[1];

    //Extracting each json objects from the metadata
    $explodedMetadata = explode("\n", $metaDataSection);
    $blogObject = [];
    foreach ($explodedMetadata as $jsonString) {
        if (empty($jsonString)) {
            continue;
        }
        $keyValuePair = preg_split("/(:)/", $jsonString, 2);
        $value = $keyValuePair[1];
        switch (strtolower($keyValuePair[0])) {
            //if key name of metadata is tag, then creating array of tags from the value
            case "tags":
                $value = explode(",", $value);
                break;
            //if the key name is published, converting value to boolean
            case "published":
                $value = (boolean)$value;
                break;
            default:
                $value = ltrim(rtrim($value, '"'), ' "');
        }
        $blogObject[$keyValuePair[0]] = $value;
    }
    //Fetching short content section from the file content. Short content located between metadata and `READMORE` string
    $shortContentSection = explode("READMORE", $fileSections[2])[0];
    //Removing unwanted new line characters from the start and end of the short content string
    $shortContentSection = ltrim(rtrim($shortContentSection, "\n"), "\n");

    //Extracting content section from the file contents. Content section located after `READMORE` string
    $contentSections = explode("READMORE", $fileContents);
    //Removing unwanted new line characters from the start and end of the content string
    $content = ltrim(rtrim($contentSections[1], "\n"), "\n");
    $blogObject["short-content"] = $shortContentSection;
    $blogObject["content"] = $content;
    array_push($blogs, $blogObject);
}
//Encoding the blog array and creating json
exit(json_encode($blogs));

