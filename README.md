# elgentos/magento2-imgproxy

## Magento 2 extension for [Imgproxy](https://imgproxy.net)
This extension automatically processes product images with the help of Imgproxy.
Read their [docs](https://docs.imgproxy.net/) to see what  Imgproxy can do.

![imgproxy](https://imgproxy.evilmartians.com/tuxMEtqXgP_uNZeNYTd7FiTh1FdEdTX8tmFXWN-XU5M/rs:fill:1160:532:1/dpr:2/g:ce/wm:0.5:soea:0:0:0.2/wmu:aHR0cHM6Ly9pbWdwcm94eS5uZXQvd2F0ZXJtYXJrLnN2Zw/plain/https:%2F%2Fwww.nasa.gov%2Fsites%2Fdefault%2Ffiles%2Fthumbnails%2Fimage%2Fpia22228.jpg)

You need to create a [Imgproxy account](https://imgproxy.net/#request) or install the [OSS variant](https://docs.imgproxy.net/installation) in order to use this extension.

## Installation
In your Magento 2 project.

```bash
composer require elgentos/magento2-imgproxy
bin/magento module:enable Elgentos_Imgproxy
bin/magento setup:upgrade
```

## Configuration
Go to Stores > Configuration > Elgentos > Imgproxy.

## Imgproxy costs
You can run it on premise or for the PRO features see [their pricing](https://imgproxy.net/#pro).
