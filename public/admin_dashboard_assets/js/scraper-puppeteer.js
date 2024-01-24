console.log('test1');

import { use, launch, executablePath as _executablePath } from 'puppeteer-extra';
import StealthPlugin from 'puppeteer-extra-plugin-stealth';

use(StealthPlugin());

const url = 'https://bot.sannysoft.com/';
console.log('test2');

async function run() {
    const browser = await launch({ headless: "new", executablePath: _executablePath() });
    const page = await browser.newPage();
    await page.goto(url);
    await page.screenshot({ path: 'public/admin_dashboard_assets/js/bot.png', fullPage: true });

    const title = await page.evaluate(() => document.title);
    console.log(title);

    // Don't forget to close the browser!
    await browser.close();
}

run();
// Attach the click event directly without using jQuery
// document.getElementById('scrapPostButton').addEventListener('click', function () {
//     run();
// });
