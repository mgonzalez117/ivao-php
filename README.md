# Ivao-php

Ivao-php is a PHP bridge for using Ivao API in PHP applications.

## Project Design

This project is designed with **DDD** and **hexagonal** architecture.

### DDD Bounded Contexts

* Shared : for common usages
* Whazzup : all implementation around Ivao Whazzup communication (file)
    * Bridge : the bridge to ivao file
    * Api : expose a php Api to reuse ivao file

## Features

### IVAO Whazzup File Api

Implementation for https://wiki.ivao.aero/en/home/devops/api/documentation-v2

* Implements reading Whazzup v2 basic API : https://wiki.ivao.aero/en/home/devops/api/whazuup/how-to-retrieve-v2, https://wiki.ivao.aero/en/home/devops/api/whazuup/file-format-v2

### IVAO OpenApi

implementation for https://api.ivao.aero/docs

**Status : Not implemented** (because of ivao restrictions access, actually i have no access)

