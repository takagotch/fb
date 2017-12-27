require 'koala'

graph = Koala::Facebook::API.new('facebook_access_token')

seartch = graph.search('BRAVIA')
seartch.each {|result|
  puts result['message']

  who = graph.get_object(result['from']['id'].to_s)
  puts "sex: " + who['sex'].to_s
  puts "birthday: " + who['birthday'].to_s
}
