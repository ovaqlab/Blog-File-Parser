# Blog Parser
Blog parser is a basic specific file parser library. From the specific files, this parser create the array of json object. this will be used to render the blog list.
Here example files added in the **/blogs** directory.
If you want to test this parser, you have to specify the document root in the **blog_parser.php**.
after that execute the index.php.

input files should be in the format of

```
---
title: "Your Title"
description: "Description"
preview_image: "image path"
section: "section name"
author: "author name"
date: "dat time"
tags: tag1, tag2, tag3
published: true
---

Short-content section.........

READMORE

Contents .........
```

output of this parser will be like follows:

```
[{
  "title": "title",
  "description": "Description",
  "author": "Author name",
  "date": "Date time",
  "tags": ["tag1", "tag2", "tag3"],
  "published": true,
  "short-content": "Short conten",
  "content": "contents"
}] 
```
