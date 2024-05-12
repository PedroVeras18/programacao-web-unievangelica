import { MakeCreateCarUseCase } from '@/use-cases/factories/make-car-factory'
import { FastifyReply, FastifyRequest } from 'fastify'
import { z } from 'zod'

export async function createCarController(
  request: FastifyRequest,
  reply: FastifyReply,
) {
  const createCarBodySchema = z.object({
    brand: z.string(),
    model: z.string(),
    year: z.number(),
    color: z.string(),
  })

  const { brand, model, year, color } = createCarBodySchema.parse(request.body)

  try {
    const createCarUseCase = MakeCreateCarUseCase()

    await createCarUseCase.execute({
      brand,
      color,
      model,
      year,
    })
  } catch (error) {}

  return reply.status(201).send()
}
