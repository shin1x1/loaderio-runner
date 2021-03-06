# loaderio-runner

[![Build Status](https://travis-ci.org/shin1x1/loaderio-runner.svg?branch=master)](https://travis-ci.org/shin1x1/loaderio-runner)

## 1. Create test cases in loader.io

You create test cases in loader.io site. Test case title is important. If you execute test case using loaderio-runner then you should start number and add dot(ex. 1.) in title.

```
1. first test
2. second test
3. third test
no execution from loaderio-runner
```

## 2. Get API Key

You get API key in below link.

https://heroku.loader.io/settings#api

## 3. Install

You install loaderio-runner command using composer.

```
$ composer global require 'shin1x1/loaderio-runner:dev-master'
```

## 4. Run loaderio-runner command

You run loaderio-runner command with API key.

```
$ loaderio-runner API_KEY
```
