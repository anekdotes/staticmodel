# Anekdotes Staticmodel

[![Latest Stable Version](https://poser.pugx.org/anekdotes/staticmodel/v/stable)](https://packagist.org/packages/anekdotes/staticmodel)
[![Build Status](https://travis-ci.org/anekdotes/staticmodel.svg?branch=master)](https://travis-ci.org/anekdotes/staticmodel)
[![codecov.io](https://codecov.io/gh/anekdotes/staticmodel/coverage.svg)](https://codecov.io/gh/anekdotes/staticmodel?branch=master)
[![StyleCI](https://styleci.io/repos/64481714/shield?style=flat)](https://styleci.io/repos/64481714)
[![License](https://poser.pugx.org/anekdotes/staticmodel/license)](https://packagist.org/packages/anekdotes/staticmodel)
[![Total Downloads](https://poser.pugx.org/anekdotes/staticmodel/downloads)](https://packagist.org/packages/anekdotes/staticmodel)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/50134febcefe4cc78daf07ca45969728)](https://www.codacy.com/app/Grasseh/staticmodel?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=anekdotes/staticmodel&amp;utm_campaign=Badge_Grade)

Abstract class used to create static Model classes. These classes have their data initiated in themselves. Allows Model operations to be used to a certain extent.

## Installation

Install via composer into your project:

    composer require anekdotes/staticmodel

## Usage

Create your static class by inheriting StaticModel. Fill it with your static data.

```php
class Languages extends StaticModel {

  public static $data = array(
    array(                 
      'id' => 1,           
      'name' => 'English',
      'small' => 'en' 
    )
  );
      
}       
```


You can then call the model as any other Illuminate model, and use most of Illuminate's functionalities.

```php
$english = Languages::find(1);
$englishname = $english->name;
```
