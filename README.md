# elgentos/magento2-imgproxy

## Magento 2 extension for [Imgproxy](https://imgproxy.com)

This extension automatically processes product images with the help of Imgproxy. See what you can do with Imgproxy in their [sandbox](https://sandbox.imgproxy.com/view?url=https%3A%2F%2Fassets.imgproxy.net%2Fhp%2Fsnowshoe.jpg%3Fmarkalign%3Dtop%26markpad%3D20%26markscale%3D8%26mark64%3DaHR0cHM6Ly9hc3NldHMuaW1naXgubmV0L2hwL3dhbmRlci1sb2dvLmFpP3c9MzAwJmZtPXBuZw%26bm%3Dnormal%26bx%3D0%26blend64%3DaHR0cHM6Ly9hc3NldHMuaW1naXgubmV0L2hwL3NhbGUtYmx1ZS5wbmc_aD02MDE%26fp-z%3D1.59%26fp-y%3D.43%26fp-x%3D.41%26crop%3Dfocalpoint%26fit%3Dcrop%26h%3D600%26w%3D900%26auto%3Dcompress%26q%3D70).

![imgproxy](https://user-images.githubusercontent.com/431360/94149268-f4368b00-fe77-11ea-80ca-3622f3f78670.png)


You need to create a [Imgproxy account](https://dashboard.imgproxy.com/sign-up) in order to use this extension.

## Configuration

Go to Stores > Configuration > Elgentos > Imgproxy. You should set your host URL for the image service (for example `https://yoursubdomain.imgproxy.net/`). You can find this value under [Sources](https://dashboard.imgproxy.com/sources) in your Imgproxy dashboard.

There's also the option to set trimming of the image. The options are: No trimming, auto and color. You can find more info [here](https://docs.imgproxy.com/apis/rendering/trim/trim)

## Imgproxy costs

For a webshop with about 15.000 products with one image each, Imgproxy costs will be anywhere between $50 and $100 monthly.
