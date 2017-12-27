require 'open-uri'
require 'rexml/document'
require 'json'

def get_xml_doc(url)
  return REXML::Document.new(open(url))

  base_url = "http://takagoch.com/sitemap.xml"
  sitemaps = get_xml_doc(base_url)
  sitemaps.elements.each('sitemapindex/sitemap/loc') do |element|

    sitemap = get_xml_doc(element.text)
    sitemap.elements.each('urlset/url/loc')
      do |element|
      response = open(
        "http://graph.facebook.com/#{element.text}").read
      json = JOSN.parse(response)
      puts json['id'] #show
      puts "likes"+json['shares'].to_s if json.key?('share')
      end
end

