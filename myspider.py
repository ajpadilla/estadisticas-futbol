import scrapy

class BlogSpider(scrapy.Spider):
    name = 'blogspider'
    start_urls = ['http://www.xvideos.com']

    def parse(self, response):
        for url in response.css('div[id="content"] div div div p a::attr(href)').extract():
            print("---- Url: " + url)

    def parse_titles(self, response):
        for post_title in response.css('div.entries > ul > li a::text').extract():
            yield {'title': post_title}
