=== Login with NEAR ===
Tags: Near, login
Requires at least: 6.0.1
Requires PHP: 7.4
Tested up to: 6.1
Stable tag: 0.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Login with NEAR WordPress plugin, allows users to register/login with NEAR wallets.

== Description ==

Login with NEAR WordPress plugin allows to easy setup and customize login with NEAR functionality at your WordPress site by using simple shortcode.

**Benefits**

1. **Provides the most popular Near Wallets**: Plugin supports "Near Wallet", "My Near Wallet", "Here Wallet", "Meteor Wallet" "Sender".

2. **Easy registration and login**: If user has a Near Wallet, he already can use all functionality from your site and identified as WP User.

3. **Call smart contracts from single endpoint**: Plugin is a wrapped implementation for official Near Wallet Selector (https://github.com/near/wallet-selector). If you use a smart contract it provides possibility to use limited access key for it. Also, you can make calls to change/view methods on another smart contracts.

4. **Easy to modify**: You can easy change login, logout button text and provide advanced classed to customize style from code

== For plugin developers ==
* If you want to create plugin with smart contract and call it from logged users you can simply do it in this way:
* view method: await window.mainWallet.viewMethod({contractId: string, method: string, args: {} }
* change method: await window.mainWallet.callMethod({contractId: string, method: string, args: {}, gas: number, deposit: number})


== Screenshots ==

1. Fill the form with your configs: contract-id (your contract id, optional), login/logout button text (text that will be presented on frontend) classes (for extra styles), network (to use testnet or mainnet) screenshot-1.png.
2. Add shortcode to [login_near_link] to any place on your site.
3. Link will be on your site  screenshot-3.png.
4. For now plugin supports NearWallet, MyNearWallet, Here Wallet screenshot-4.png.
5. Logout button will replace login button after login screenshot-5.png.

== Changelog ==
= 0.0.2 =
* [Improvement] Improved wallet integration and contract calls
