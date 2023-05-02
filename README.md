# elgentos/magento2-imgix

## Magento 2 extension for [Imgix](https://imgix.com)

This extension automatically processes product images with the help of Imgix. See what you can do with Imgix in their [sandbox](https://sandbox.imgix.com/view?url=https%3A%2F%2Fassets.imgix.net%2Fhp%2Fsnowshoe.jpg%3Fmarkalign%3Dtop%26markpad%3D20%26markscale%3D8%26mark64%3DaHR0cHM6Ly9hc3NldHMuaW1naXgubmV0L2hwL3dhbmRlci1sb2dvLmFpP3c9MzAwJmZtPXBuZw%26bm%3Dnormal%26bx%3D0%26blend64%3DaHR0cHM6Ly9hc3NldHMuaW1naXgubmV0L2hwL3NhbGUtYmx1ZS5wbmc_aD02MDE%26fp-z%3D1.59%26fp-y%3D.43%26fp-x%3D.41%26crop%3Dfocalpoint%26fit%3Dcrop%26h%3D600%26w%3D900%26auto%3Dcompress%26q%3D70).

![imgix](https://user-images.githubusercontent.com/431360/94149268-f4368b00-fe77-11ea-80ca-3622f3f78670.png)


You need to create a [Imgix account](https://dashboard.imgix.com/sign-up) in order to use this extension.

## Configuration

Go to Stores > Configuration > Elgentos > Imgix. You should set your host URL for the image service (for example `https://yoursubdomain.imgix.net/`). You can find this value under [Sources](https://dashboard.imgix.com/sources) in your Imgix dashboard.

There's also the option to set trimming of the image. The options are: No trimming, auto and color. You can find more info [here](https://docs.imgix.com/apis/rendering/trim/trim)

## Imgix costs

For a webshop with about 15.000 products with one image each, Imgix costs will be anywhere between $50 and $100 monthly.