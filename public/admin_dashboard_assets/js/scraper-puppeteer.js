import fs from 'fs';
import puppeteer from 'puppeteer';

async function run() {
    const browser = await puppeteer.launch({ headless: "new" });
    const page = await browser.newPage();
    await page.goto('https://www.traversymedia.com');

    // await page.screenshot({ path:'public/admin_dashboard_assets/js/scraper-example.png', fullPage: true });
    // await page.pdf({ path:'public/admin_dashboard_assets/js/scraper-example.pdf', format: 'A4' });
    
    // const html = await page.content();
    // console.log(html);

    // const title = await page.evaluate(() => document.title);
    // console.log(title);

    // const text = await page.evaluate(() => document.body.innerText);
    // console.log(text);

    // const links = await page.evaluate(() => 
    //     Array.from(document.querySelectorAll('a'), (e) => e.href)
    // );
    // console.log(links);

    // const courses = await page.evaluate(() => 
    //     Array.from(document.querySelectorAll('#cscourses .card'), (e) => ({
    //         title: e.querySelector('.card-body h3').innerText,
    //         level: e.querySelector('.card-body .level').innerText,
    //         url: e.querySelector('.card-footer a').href,
    //     }))
    // );
    // console.log(courses);

    const courses = await page.$$eval('#cscourses .card', (elements) => 
        elements.map(e => ({
            title: e.querySelector('.card-body h3').innerText,
            level: e.querySelector('.card-body .level').innerText,
            url: e.querySelector('.card-footer a').href,
        }))
    );
    console.log(courses);

    // Save data to a json file with indentation
    fs.writeFile('public/admin_dashboard_assets/js/scraper-example-courses.json', JSON.stringify(courses, null, 2), (err) => {
        if (err) throw err;
        console.log('File saved');
    });

    // Don't forget to close the browser!
    await browser.close();
}

run();
