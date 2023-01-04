# Ivao-php

**/!\ No released yet**, technology watch project for now.

Ivao-php is a PHP bridge for using Ivao API in PHP applications.

## Project Design

This project is designed with **DDD** and **hexagonal** architecture.

### DDD Bounded Contexts

* Shared : for common usage
* Client : main clients for PHP bridge usage in your application
  * The model have been created from v2 api model to simplify understanding and usage, see ivao docs to use bridge results : https://api.ivao.aero/docs
* Whazzup : implementation around Ivao Whazzup file communication

## Api Bridges

### Whazzup (File Api)

Implementation for https://wiki.ivao.aero/en/home/devops/api/documentation-v2

* Implements reading Whazzup v2 basic API : https://wiki.ivao.aero/en/home/devops/api/whazuup/how-to-retrieve-v2, https://wiki.ivao.aero/en/home/devops/api/whazuup/file-format-v2

### IVAO OpenApi (v2)

implementation for https://api.ivao.aero/docs

**Status : Not implemented** (because of ivao restrictions access, actually i have no access)

