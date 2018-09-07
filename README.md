# ShopwareAttributeRestApi

A Shopware plugin that exposes the free text fields (attributes) via REST API.

## About

This plugin uses the [Attribute Crud Service](https://developers.shopware.com/developers-guide/attribute-system/) to
expose attributes vie REST API.

It's intended to be used for automation of the free text field management.

## Setup

Enable API Access as explained in
 Shopware's REST API Documentation](https://developers.shopware.com/developers-guide/rest-api/#basic-settings).

## Usage

The `attributes` resource supports the following operations:

| Name           |  Access URL     | GET    | GET (List) | PUT | PUT (Batch) | POST | DELETE | DELETE (Batch) |
|----------------|-----------------|--------|------------|-----|-------------|------|--------|----------------|
| **attributes** | /api/attributes |  Yes   | YES        | YES | NO          | YES  | YES    | NO             |

Due to the design of Shopware's attribute crud service, it might be possible to update with POST and create with PUT!

### GET

**table_name** is used as ID.

#### Required Parameters

| Identifier   | Parameter | Example call                                           |
|--------------|-----------|--------------------------------------------------------|
| column_name  | string    | /api/attributes/s_article_attributes?column_name=attr1 |

#### Return Value

### GET (List)

#### Required Parameters

| Identifier  | Parameter | Example call                         |
|-------------|-----------|--------------------------------------|
| table_name  | string    | /api/attributes/s_article_attributes |

### PUT

* columnName (required), string,
* unifiedType, string, defaults to
* data, array
    * displayInBackend, boolean
    * translatable, boolean
    * core, boolean
    * label, string
    * ...

```
{
    "columnName": "attr99",
    "unifiedType": "text",
    "data": {
        "displayInBackend": true,
        "translatable": true,
        "core": true,
        "label": "Attribut 99"
    }
}
```

### POST

* tableName (required), string
* columnName (required), string,
* unifiedType, string, defaults to
* data, array
    * displayInBackend, boolean
    * translatable, boolean
    * core, boolean
    * label, string
    * ...

```
{
    "tableName": "s_articles_attributes",
    "columnName": "attr99",
    "unifiedType": "text",
    "data": {
        "displayInBackend": true,
        "translatable": true,
        "core": true,
        "label": "Attribut 99"
    }
}
```
### DELETE

## Contributing

We use [Shopware's Vagrant Setup](https://github.com/shopwareLabs/shopware-vagrant) for development.

After Setup, you map/sync the plugin code into the vagrant box.

One way to do this, is updating the `Vagrantfile` with something similar like this:
```
config.vm.synced_folder "../ShopwareAttributeRestApi", "/home/vagrant/www/shopware/custom/plugins/ShopwareAttributeRestApi", create: true, type: "nfs"
```

We provide a basic [Postman Collection](Shopware_Attribute_REST_API.postman_collection.json) for testing.

## License

Please see [License File](LICENSE) for more information.
